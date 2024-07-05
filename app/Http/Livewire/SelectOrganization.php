<?php

namespace App\Http\Livewire;

use App\Events\ProfileSwitchEvent;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;

class SelectOrganization extends Component
{
    use Actions;

    public $user;
    public $userOrganizations = [];
    public $organizationId;
    public $notifySwitchProfile;
    public $activeProfile = [];

    public function mount()
    {
        $this->user = Auth::user();
        $orgs = User::with('organizations')->find(Auth::user()->id)->organizations;
        $this->userOrganizations = $orgs->map(function ($org, $key) {
            return [
                'id' => $org->id,
                'name' => $org->name,
                'photo' => $org->profile_photo_path
             ];
        });
    }


    /**
     * Get the event listeners for the component.
     * Listens for the ProfileSwitchEvent event on the switch-profile.{$this->user->id} private Echo channel. When this event is fired, the notifySwitchProfile method of the component will be called.
     * @return array
     */
    public function getListeners()
    {
        return [
            "echo-private:switch-profile.{$this->user->id},ProfileSwitchEvent" => 'notifySwitchProfile',
        ];
    }


    public function organizationSelected()
    {
        $organizationId = $this->organizationId;

        if ($organizationId != null) {
            Session([
                'activeProfileType' => Organization::class,
                'activeProfileId' => $organizationId,
                'activeProfileName' => $this->userOrganizations[$organizationId - 1]['name'],
                'activeProfilePhoto' => $this->userOrganizations[$organizationId - 1]['photo'],
                'activeProfileAccounts' => Organization::find($organizationId)->accounts()->pluck('id')->toArray()
            ]);
        } else {
            Session([
                'activeProfileType' => User::class,
                'activeProfileId' => Auth::user()->id,
                'activeProfileName' => $this->user->name,
                'activeProfilePhoto' => $this->user->profile_photo_path,
                'activeProfileAccounts' => User::find($this->user->id)->accounts()->pluck('id')->toArray()
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

        redirect('/dashboard')->with('success', 'Active profile has switched!');

    }


    public function render()
    {
        return view('livewire.select-organization');
    }
}
