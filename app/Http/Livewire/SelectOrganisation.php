<?php

namespace App\Http\Livewire;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RTippin\Messenger\Messenger;

class SelectOrganisation extends Component
{
    public $user;
    public $userOrganisations = [];
    public $organisationId;

    public function mount()
    {
        $this->user = Auth::user();
        $orgs = User::with('organisations')->find(Auth::user()->id)->organisations;
        $this->userOrganisations = $orgs->map(function ($org, $key) {
            return [
                'id' => $org->id,
                'name' => $org->name,
                'profile_photo_path' => $org->profile_photo_path
             ];
        });
    }

    public function organisationSelected($organisationId = null)
    {
        if ($organisationId != null) {
            Session([
                'activeProfileType' => Organisation::class,
                'activeProfileId' => $organisationId]);
        } else {
            Session([
                'activeProfileType' => User::class,
                'activeProfileId' => Auth::user()->id]);
        }
        return redirect()->route('dashboard');
    }



    public function render()
    {
        return view('livewire.select-organisation');
    }
}
