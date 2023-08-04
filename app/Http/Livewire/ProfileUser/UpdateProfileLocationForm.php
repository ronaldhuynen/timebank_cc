<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\Division;
use App\Models\Locations\Location;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class UpdateProfileLocationForm extends Component
{
    use Actions;

    public $state;
    public $country;
    public $division;
    public $city;
    public $validateCountry = true;
    public $validateDivision = true;
    public $validateCity = true;
    public $district;

    protected $listeners = ['countryToParent', 'divisionToParent', 'cityToParent'];

    public function rules()
    {
        return [
        'country' => 'required_if:validateCountry,true',
        'division' => 'required_if:validateDivision,true',
        'city' => 'required_if:validateCity,true',
        ];
    }

    /**
    * Prepare the component.
    *
    * @return void
    */
    public function mount()
    {
        $this->state = session('activeProfileType')::find(session('activeProfileId'))->load(['locations', 'locations.countries', 'locations.divisions', 'locations.cities']);

        if ($this->state->locations->first()->countries()->count() > 0) {
            // For now we only use a single location. In the future this can become an array of locations.
            $this->country = $this->state->locations->first()->countries()->first()->id;
            $this->emit('countryToChildren', $this->country);
        }


        if ($this->state->locations->first()->divisions()->count() > 0) {
            // For now we only use a single location. In the future this can become an array of locations.
            $this->division = $this->state->locations->first()->divisions()->first()->id;
        }


        if ($this->state->locations->first()->cities()->count() > 0) {
            // For now we only use a single location. In the future this can become an array of locations.
            $this->city = $this->state->locations->first()->cities()->first()->id;

            // In case a city without a country is present in the db:
            if ($this->state->locations->first()->countries()->count() === 0) {
                $this->country = City::find($this->city)->country_id;
            }
        }

        $this->setValidationOptions();

    }


    public function countryToParent($value)
    {
        $this->country = $value;
        $this->setValidationOptions();
    }


    public function divisionToParent($value)
    {
        $this->division = $value;
        $this->setValidationOptions();

    }


    public function cityToParent($value)
    {
        $this->city = $value;
        $this->setValidationOptions();
    }


    public function emitLocationToChildren()
    {
        $this->emit('countryToChildren', $this->country);
        $this->emit('divisionToChildren', $this->division);
        $this->emit('cityToChildren', $this->city);
    }


    public function setValidationOptions()
    {
        $this->validateCountry = $this->validateDivision = $this->validateCity = true;

        $countDivisions = Country::find($this->country)->divisions()->count();
        $countCities = Country::find($this->country)->cities()->count();

        // In case no cities or divisions for selected country are seeded in database
        if ($this->country) {
            if ($countDivisions > 0 && $countCities < 1) {
                $this->validateDivision = true;
                $this->validateCity = false;
            } elseif ($countDivisions < 1 && $countCities > 1) {
                $this->validateDivision = false;
                $this->validateCity = true;
            } elseif ($countDivisions < 1 && $countCities < 1) {
                $this->validateDivision = false;
                $this->validateCity = false;
            } elseif ($countDivisions > 0 && $countCities > 0) {
                $this->validateDivision = false;
                $this->validateCity = true;
            }

        }
        // In case no country is selected, no need to show other validation errors
        if (!$this->country) {
            $this->validateCountry = true;
            $this->validateDivision = $this->validateCity = false;
        }

    }



    public function updateProfileInformation()
    {
        $this->validate();

        // Use a transaction for creating the new user.
        DB::transaction(function (): void {

            // For now we only use a single location. In the future this can become an array of locations.
            if ($this->state->locations()) {
                $location = Location::find($this->state->locations()->first()->id);
            } else {
                $location = new Location();
                $location->name = 'Default location';
                session('activeProfileType')::find(session('activeProfileId'))->locations()->save($location); // create a new location
            }
            $country = new Country();
            $country = $this->country;
            $location->countries()->sync($country); // attach country to location

            $division = new Division();
            $division= $this->division;
            $location->divisions()->sync($division);  // attach city to location

            $city = new City();
            $city = $this->city;
            $location->cities()->sync($city);  // attach city to location

            $this->emit('saved');
        });
    }


    public function render()
    {
        return view('livewire.profile-organization.update-profile-location-form');
    }
}
