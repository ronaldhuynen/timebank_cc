<?php

namespace App\Http\Livewire\ProfileUser;


use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;

class UpdateProfileLocationForm extends Component
{
    public $state = [];
    public $country;
    public $city;
    public $district;

    protected $listeners = ['countryToParent', 'cityToParent', 'districtToParent'];

    public function rules()
    {
        return [
        'country' => 'required',
        'city' => 'required'
        ];
    }


    public function countryToParent($value)
    {
        $this->country = $value;
    }


    public function cityToParent($value)
    {
        $this->city = $value;
    }


    public function districtToParent($value)
    {
        $this->district = $value;
    }

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
    }

    /**
     * Update the user's profile location information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );


        $this->emit('saved');

        $this->emit('refresh-navigation-menu');
    }


    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }


    public function render()
    {
        return view('livewire.profile-user.update-profile-location-form');
    }
}
