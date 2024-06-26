<?php

namespace App\Http\Livewire\ProfileOrg;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\District;
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
    public $district;
    public $validateCountry = true;
    public $validateDivision = true;
    public $validateCity = true;

    protected $listeners = ['countryToParent', 'divisionToParent', 'cityToParent', 'districtToParent'];

    public function rules()
    {
        return [
        'country' => 'required_if:validateCountry,true|integer',
        'division' => 'required_if:validateDivision,true|nullable|integer',
        'city' => 'required_if:validateCity,true|nullable|integer',
        'district' => 'nullable|integer'
        ];
    }

    /**
    * Prepare the component.
    *
    * @return void
    */
    public function mount()
    {
        $this->state = session('activeProfileType')::find(session('activeProfileId'))
            ->load([
                'locations',
                'locations.country',
                'locations.division',
                'locations.city',
                'locations.district']);

        if (!$this->state->location->first()) {

            if ($this->state->locations->first()->country) {
                // For now we only use a single location. In the future this can become an array of locations.
                $this->country = $this->state->locations->first()->country->id;
                $this->emit('countryToChildren', $this->country);
            }


            if ($this->state->locations->first()->division) {
                // For now we only use a single location. In the future this can become an array of locations.
                $this->division = $this->state->locations->first()->division->id;
            }


            if ($this->state->locations->first()->city) {
                // For now we only use a single location. In the future this can become an array of locations.
                $this->city = $this->state->locations->first()->city->id;

                // In case a location has a city without a country in the db:
                if (!$this->state->locations->first()->country) {
                    $this->country = City::find($this->city)->country_id;
                }
            }

            if ($this->state->locations->first()->district) {
                // For now we only use a single location. In the future this can become an array of locations.
                $this->district = $this->state->locations->first()->district->id;

                // In case a location has a district without a city in the db:
                if (!$this->state->locations->first()->city) {
                    $this->city = District::find($this->district)->city_id;
                }
            }
        }
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


    public function districtToParent($value)
    {
        $this->district = $value;
        $this->setValidationOptions();
    }


    public function emitLocationToChildren()
    {
        $this->emit('countryToChildren', $this->country);
        $this->emit('divisionToChildren', $this->division);
        $this->emit('cityToChildren', $this->city);
        $this->emit('districtToChildren', $this->district);
    }


    public function setValidationOptions()
    {
        $this->validateCountry = $this->validateDivision = $this->validateCity = true;

        // In case no cities or divisions for selected country are seeded in database
        if ($this->country) {

            $countDivisions = Country::find($this->country)->divisions()->count();

            $countCities = Country::find($this->country)->cities()->count();

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
        ds($this->district)->label('district in setValidationOptions');
    }



    public function updateProfileInformation()
    {
        $this->validate();

        // Use a transaction for creating the new user.
        DB::transaction(function (): void {

            // For now we only use a single location. In the future this can become an array of locations.
            if ($this->state->locations) {
                $location = Location::find($this->state->locations->first()->id);
            } else {
                $location = new Location();
                session('activeProfileType')::find(session('activeProfileId'))->locations()->save($location); // create a new location
            }
            // Set country, division, and city IDs on the location
            $location->country_id = $this->country;
            $location->division_id = $this->division;
            $location->city_id = $this->city;
            $location->district_id = $this->district;


            // Save the location with the updated relationship IDs
            $location->save();

            $this->emit('saved');
        });
    }



    public function render()
    {
        return view('livewire.profile-org.update-profile-location-form');
    }
}
