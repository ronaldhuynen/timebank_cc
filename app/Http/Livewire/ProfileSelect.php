<?php

namespace App\Http\Livewire;

use App\Events\ProfileSwitchEvent;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Stevebauman\Location\Facades\Location as IpLocation;
use WireUi\Traits\WireUiActions;


class ProfileSelect extends Component
{
    use WireUiActions;

    protected $user;
    public $userName;
    public $userProfiles = [];
    public $userProfileIndex;
    public $notifySwitchProfile;
    public $activeProfile = [];

    /**
     * Get the event listeners for the component.
     * Listens for the ProfileSwitchEvent event on the switch-profile.{$userId} private Echo channel. When this event is fired, the notifySwitchProfile method of the component will be called.
     * @return array
     */
    protected function getListeners()
    {
        $userId = Auth::id(); // Get the authenticated user's ID

        return [
            "echo-private:switch-profile.{$userId},ProfileSwitchEvent" => 'notifySwitchProfile',
        ];
    }


    public function mount()
    {
        $this->user = Auth::user();
        $this->userName = $this->user->name;

        // Eager load profile relationships
        $userWithRelations = User::with([
            'organizations', 
            'banks', 
            'admins'
            ])->find($this->user->id);

        // Get organizations and banks
        $orgs = $userWithRelations->organizations;
        $banks = $userWithRelations->banks;
        $admins = $userWithRelations->admins;

        // Merge profiles  collections
        $profiles = $orgs
            ->merge($banks)
            ->merge($admins);

        // Map the merged collection to the desired structure
        $this->userProfiles = $profiles->map(function ($profile) {
            if ($profile instanceof Organization) {
                $type = 'organization';
            } elseif ($profile instanceof Bank) {
                $type = 'bank';
            } elseif ($profile instanceof Admin) {
                $type = 'admin';
            } else {
                $type = 'unknown';
            }

            return [
                'id' => $profile->id,
                'type' => $type,
                'name' => $profile->name,
                'photo' => $profile->profile_photo_path,
            ];
        })->toArray();

    }


    public function profileSelected()
    {
        $this->switchProfile();
    }


    public function switchProfile()
    {
        $index = $this->userProfileIndex;

        // If index is missing or out of range, switch to the auth user without warning
        if ($index === null || !isset($this->userProfiles[$index])) {
            return $this->switchToAuthUser(); 
        }

        $profileArray = $this->userProfiles[$index];
        $profileType = ucfirst($profileArray['type']);
        $profileId   = $profileArray['id'];

        // If the user is switching to their own User profile, switch without warning
        if ($profileType === 'User' && (int) $profileId === Auth::id()) {
            return $this->switchToAuthUser();
        }

        // Otherwise, attempt to find and validate the model
        $profileClassName = 'App\\Models\\' . $profileType;
        $profileModel     = $profileClassName::find($profileId);

        // If the model doesn't exist or the user doesn't own it, fall back with a warning
        if (!$profileModel || !$this->userOwnsProfile($profileModel)) {
            return $this->fallbackToAuthUser();
        }

        // Switch to the chosen profile
        Session([
            'activeProfileType'  => $profileClassName,
            'activeProfileId'    => $profileModel->id,
            'activeProfileName'  => $profileModel->name,
            'activeProfilePhoto' => $profileModel->profile_photo_path,
            'profile-switched-notification' => true,
        ]);

        // Fire the event, redirect, etc.
        event(new ProfileSwitchEvent($profileModel));

        return redirect()->route('dashboard');
    }


    /**
     * Switch to the authenticated user's own profile without logging a warning.
     */
    protected function switchToAuthUser()
    {
        $user = Auth::user();

        Session([
            'activeProfileType'  => \App\Models\User::class,
            'activeProfileId'    => $user->id,
            'activeProfileName'  => $user->name,
            'activeProfilePhoto' => $user->profile_photo_path,
            'profile-switched-notification'   => true,
        ]);

        event(new ProfileSwitchEvent($user));

        return redirect()->route('dashboard');
    }

    
    /**
     * If user tampered with the front-end, we fall back to the default user profile.
     */
    protected function fallbackToAuthUser()
    {
        $user = Auth::user();
        Session([
            'activeProfileType'  => \App\Models\User::class,
            'activeProfileId'    => $user->id,
            'activeProfileName'  => $user->name,
            'activeProfilePhoto' => $user->profile_photo_path,
            'activeProfileAccounts' => $user->accounts()->pluck('id')->toArray(),
        ]);

        $activeProfile = [
            'userId' => $user->id,
            'type'   => session('activeProfileType'),
            'id'     => session('activeProfileId'),
            'name'   => session('activeProfileName'),
            'photo'  => session('activeProfilePhoto'),
        ];

        $warningMessage = 'Unauthorized profile switch attempt';

        $this->logAndReport($warningMessage);
        
        session()->flash('error', __($warningMessage) . '. ' . __('This event has been logged') . '!');
        session(['unauthorizedAction' => __($warningMessage) . '. ' . __('This event has been logged') . '!']);
                
        return event(new ProfileSwitchEvent($activeProfile));
    }

    /**
     * Checks if the user actually "owns" this profile.
     */
    protected function userOwnsProfile($profileModel)
    {
        $user = Auth::user();
        
        // Check if the profile model is an instance of the User model
        if ($profileModel instanceof \App\Models\User) {
            return $profileModel->id === $user->id;
        }

        // Example for Organization / Bank / Admin relationships:
        // If the model has a `users()` relationship, check if the user is in there
        if (method_exists($profileModel, 'users')) {
            return $profileModel->users->contains($user);
        }

        return false;

    }


    public function notifySwitchProfile($activeProfile)
    {
        $this->notifySwitchProfile = true;

        Session([
                    'activeProfileType' => $activeProfile['type'],
                    'activeProfileId' => $activeProfile['id'],
                    'activeProfileName' => $activeProfile['name'],
                    'activeProfilePhoto' => $activeProfile['photo'],
                    'profile-switched-notification' => true,
                ]);

        return redirect()->route('dashboard');
    }


    /**
     * Logs a warning message and reports it via email to the system administrator.
     *
     * This method logs a warning message with detailed information about the event,
     * including account details, user details, IP address, and location. It also
     * sends an email to the system administrator with the same information.
     */
    private function logAndReport($warningMessage, $error = '')
    {
        $ip = request()->ip();
        $ipLocationInfo = IpLocation::get($ip);

        // Escape ipLocation errors when not in production
        if (!$ipLocationInfo || App::environment(['local', 'development', 'staging'])) {
            $ipLocationInfo = (object) [
                'cityName' => 'local City',
                'regionName' => 'local Region',
                'countryName' => 'local Country',
            ];
        }
        $eventTime = now()->toDateTimeString();

        // Log this event and mail to admin
        Log::warning($warningMessage, [
            'userId' => Auth::id(),
            'userName' => Auth::user()->name,
            'activeProfileId' => session('activeProfileId'),
            'activeProfileType' => session('activeProfileType'),
            'activeProfileName' => session('activeProfileName'),
            'IP address' => $ip,
            'IP location' => $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName,
            'Event Time' => $eventTime,
            'Message' => $error,
        ]);
        Mail::raw(
            $warningMessage . '.' . "\n\n" .
            'User ID: ' . Auth::id() . "\n" . 'User Name: ' . Auth::user()->name . "\n" .
            'Active Profile ID: ' . session('activeProfileId') . "\n" .
            'Active Profile Type: ' . session('activeProfileType') . "\n" .
            'Active Profile Name: ' . session('activeProfileName') . "\n" .
            'IP address: ' . $ip . "\n" .
            'IP location: ' . $ipLocationInfo->cityName . ', ' . $ipLocationInfo->regionName . ', ' . $ipLocationInfo->countryName . "\n" .
            'Event Time: ' . $eventTime . "\n\n" .
            $error,
            function ($message) use ($warningMessage) {
                $message->to(config('timebank-cc.mail.system_admin'))->subject($warningMessage);
            },
        );

        session()->flash('error', __($warningMessage) . '. ' . __('This event has been logged and reported to our system administrator') . '.');
    }


    public function render()
    {
        return view('livewire.profile-select');
    }
}
