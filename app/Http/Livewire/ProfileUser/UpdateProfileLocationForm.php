<?php

namespace App\Http\Livewire\ProfileUser;


use App\Models\Account;
use App\Models\User;
use App\Models\Locations\Location;
use App\Models\Locations\Country;
use App\Models\Locations\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use WireUi\Traits\Actions;


class UpdateProfileLocationForm extends Component
{
    use Actions;

    public $state = [];
    public $country;
    public $city;
    public $district;

    protected $listeners = ['countryToParent', 'cityToParent'];

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


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->load(['locations', 'locations.countries', 'locations.cities'])->toArray();
        $this->country = $this->state['locations'][0]['countries'][0]['id'];
        $this->city = $this->state['locations'][0]['cities'][0]['id'];
    }


    public function emitLocationToChildren()
    {
        $this->emit('countryToChildren', $this->country);
        $this->emit('cityToChildren', $this->city);
    }


    /**
     * Update the user's profile location information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {

        $valid = $this->validate();
        // $this->resetErrorBag();


        try {
            // Use a transaction for creating the new user
            DB::transaction(function () use ($valid): void {

                // For now we only use a single location. In the future this can become an array of locations.
                $location = Location::find($this->state['locations'][0]['id']);

                $country = new Country();
                $country = $valid['country'];
                $location->countries()->sync($country);

                $city = new City();
                $city = $valid['city'];
                $location->cities()->sync($city);

                $this->emit('saved');
            });
            // End of transaction

        } catch (Throwable $e) {
            // WireUI notification
            // TODO: create event to send error notification to admin
            $this->notification([
            'title' => __('Registration failed!'),
            'description' => __('Sorry, your data could not be saved!') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
            'icon' => 'error',
            'timeout'=> 100000
            ]);

            return back();
        }
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
