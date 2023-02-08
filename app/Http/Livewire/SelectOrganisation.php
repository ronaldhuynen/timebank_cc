<?php

namespace App\Http\Livewire;

use App\Events\ProfileSwitchEvent;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use WireUi\Traits\Actions;


class SelectOrganisation extends Component
{
    use Actions;

    public $user;
    public $userOrganisations = [];
    public $organisationId;
    public $notifySwitchProfile;
    public $activeProfile = [];

    public function mount()
    {
        $this->user = Auth::user();
        $orgs = User::with('organisations')->find(Auth::user()->id)->organisations;
        $this->userOrganisations = $orgs->map(function ($org, $key) {
            return [
                'id' => $org->id,
                'name' => $org->name,
                'photo' => $org->profile_photo_path
             ];
        });
    }


    public function getListeners()
    {
        return [
            "echo-private:switch-profile.{$this->user->id},ProfileSwitchEvent" => 'notifySwitchProfile',
        ];
    }


    Public function notifySwitchProfile($activeProfile)
    {
        $this->notifySwitchProfile = true;

        Session([
                    'activeProfileType' => $activeProfile['type'],
                    'activeProfileId' => $activeProfile['id'],
                    'activeProfileName'=> $activeProfile['name'],
                    'activeProfilePhoto'=> $activeProfile['photo']
                ]);

        redirect('/dashboard')->with('success', 'Active profile has switched!');

    }


    public function organisationSelected($organisationId = null)
    {
        if ($organisationId != null) {
            Session([
                'activeProfileType' => Organisation::class,
                'activeProfileId' => $organisationId,
                'activeProfileName'=> $this->userOrganisations[$organisationId-1]['name'],
                'activeProfilePhoto'=> $this->userOrganisations[$organisationId-1]['photo']
            ]);
        } else {
            Session([
                'activeProfileType' => User::class,
                'activeProfileId' => Auth::user()->id,
                'activeProfileName'=> $this->user->name,
                'activeProfilePhoto'=> $this->user->profile_photo_path
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



    public function render()
    {
        return view('livewire.select-organisation');
    }
}
