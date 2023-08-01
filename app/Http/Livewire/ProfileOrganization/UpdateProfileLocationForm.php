<?php

namespace App\Http\Livewire\ProfileOrganization;


use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;


class UpdateProfileLocationForm extends Component
{
    use Actions;

    public $state = [];
    public $country;
    public $city;
    public $noCityOptions = true;
    public $district;

    protected $listeners = ['countryToParent', 'cityToParent'];

    public function rules()
    {
        return [
        'country' => 'required',
        'city' => 'required_if:noCityOptions,false'
        ];
    }

     /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = session('activeProfileType')::find(session('activeProfileId'))->load(['locations', 'locations.countries', 'locations.cities'])->toArray();
        // In case no location is attached.
        if (isset($this->state['locations'][0]['countries'][0])) {
            // For now we only use a single location. In the future this can become an array of locations.
            $this->country = $this->state['locations'][0]['countries'][0]['id'];
            $this->checkCityOptions($this->country);
        }
        // In case no city is attached.
        if (isset($this->state['locations'][0]['cities'][0])) {
            // For now we only use a single location. In the future this can become an array of locations.
            $this->city = $this->state['locations'][0]['cities'][0]['id'];
            $this->country = City::find($this->city)->country_id;
        }
    }


    public function countryToParent($value)
    {
        $this->country = $value;
        $this->checkCityOptions($value);
    }


    public function cityToParent($value)
    {
        $this->city = $value;
    }


    public function emitLocationToChildren()
    {
        $this->emit('countryToChildren', $this->country);
        $this->emit('cityToChildren', $this->city);
    }

    public function checkCityOptions($country)
    {        
        // In case no cities for selected country are seeded in database
    if ($this->country) {
        $cityCount = Country::find($country)->cities()->count();
        if ($cityCount <= 1) {
            $this->noCityOptions = true;
        } else {
            $this->noCityOptions = false;
        }
    }
    }



    public function updateProfileInformation()
    {
        $valid = $this->validate();

// try {
    // Use a transaction for creating the new user.
    DB::transaction(function () use ($valid): void {

        // For now we only use a single location. In the future this can become an array of locations.
        if (isset($this->state['locations'][0])) {
            $location = Location::find($this->state['locations'][0]['id']);
        } else {
            $location = new Location();
            $location->name = 'Default location';
            session('activeProfileType')::find(session('activeProfileId'))->locations()->save($location); // create a new location
        }
        $country = new Country();
        $country = $valid['country'];
        $location->countries()->sync($country); // attach country to location

        $city = new City();
        $city = $valid['city'];
        $location->cities()->sync($city);  // attach city to location

        $this->emit('saved');
        });
    // End of transaction
    // }
        // } catch (Throwable $e) {
        //     // WireUI notification
        //     // TODO: create event to send error notification to admin
        //     $this->notification([
        //     'title' => __('Error!'),
        //     'description' => __('Sorry, your data could not be saved!') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
        //     'icon' => 'error',
        //     'timeout'=> 100000
        //     ]);

        //     return back();
        // }
        // $this->emit('refresh-navigation-menu');
    }


    public function render()
    {
        return view('livewire.profile-user.update-profile-location-form');
    }
}
