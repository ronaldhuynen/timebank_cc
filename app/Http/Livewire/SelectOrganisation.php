<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Organisation;
use Illuminate\Support\Facades\Auth;

class SelectOrganisation extends Component
{
    public $userOrganisations = [];
    public $organisationId;

    public function mount()
    {
        $orgs = User::with('organisations')->find(Auth::user()->id)->organisations;
        $this->userOrganisations = $orgs->map(function ($org, $key) {
            return [
                'id' => $org->id,
                'name' => $org->name,
                'profile_photo_path' => $org->profile_photo_path
             ];
        });
        info($this->userOrganisations);
    }

    public function organisationIdSelected($organisationId)
    {

        Session([
            'activeProfileType' => Organisation::class,
            'activeProfileId' => $organisationId]);
        $this->emit('organisationId', $organisationId);
        dd($organisationId);
    }


    public function render()
    {
        return view('livewire.select-organisation');
    }
}
