<?php

namespace App\Http\Livewire;

use App\Events\ProfileSwitchEvent;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
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


    protected function switchProfile()
    {        
        $index = $this->userProfileIndex;

        if ($index != null) {
            $profile = collect($this->userProfiles[$index]);
            
            // Determine the fully qualified class name dynamically
            $profileType = ucfirst($profile['type']);
            $profileClassName = 'App\\Models\\' . $profileType;            
            $profileModel = $profileClassName::find($profile['id']);
            // Check if the accounts() method exists on the model
            if (method_exists($profileModel, 'accounts')) {
                $accounts = $profileModel->accounts()->exists()
                    ? $profileModel->accounts()->pluck('id')->toArray()
                    : [];
            } else {
                // If accounts() method doesn't exist, set accounts to an empty array
                $accounts = [];
            }

            if ($profile) {
                Session([
                    'activeProfileType' => $profileClassName,
                    'activeProfileId' => $profile['id'],
                    'activeProfileName' => $profile['name'],
                    'activeProfilePhoto' => $profile['photo'],
                    'activeProfileAccounts' => $accounts,
                    ]);
            }
        } else {
            $user = Auth::user();
            Session([
                'activeProfileType' => User::class,
                'activeProfileId' => $user->id,
                'activeProfileName' => $user->name,
                'activeProfilePhoto' => $user->profile_photo_path,
                'activeProfileAccounts' => User::find($user->id)->accounts()->pluck('id')->toArray()
            ]);
        }

        $activeProfile = [
            'userId' => Auth::user()->id,
            'type' => Session('activeProfileType'),
            'id' => Session('activeProfileId'),
            'name' => Session('activeProfileName'),
            'photo' => Session('activeProfilePhoto')
        ];

        return event(new ProfileSwitchEvent($activeProfile));
    }


    public function notifySwitchProfile($activeProfile)
    {
        $this->notifySwitchProfile = true;

        Session([
                    'activeProfileType' => $activeProfile['type'],
                    'activeProfileId' => $activeProfile['id'],
                    'activeProfileName' => $activeProfile['name'],
                    'activeProfilePhoto' => $activeProfile['photo']
                ]);

        return redirect()->route('dashboard')->with('success', 'Active profile is switched!');
    }


    public function render()
    {
        return view('livewire.profile-select');
    }
}
