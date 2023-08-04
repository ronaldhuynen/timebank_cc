<?php

namespace App\Http\Livewire\Locations;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\Division;
use Livewire\Component;

class LocationsDropdown extends Component
{
    public $country;
    public $divisions = [];
    public $division;
    public $cities = [];
    public $city;

    protected $listeners = ['countryToChildren', 'divisionToChildren', 'cityToChildren'];


    public function countryToChildren($value)
    {
        $this->country = $value;
    }


    public function divisionToChildren($value)
    {
        $this->division = $value;
    }


    public function cityToChildren($value)
    {
        $this->city = $value;
    }


    public function updatedCountry()
    {
        $this->reset(['division', 'divisions']);
        $this->reset(['city', 'cities']);
        $this->emit('countryToParent', $this->country);
        $this->emit('divisionToParent', $this->division);
        $this->emit('cityToParent', $this->city);
    }


    public function countrySelected()
    {
        $this->emit('countryToParent', $this->country);
    }


    public function divisionSelected()
    {
        $this->emit('divisionToParent', $this->division);
    }


    public function citySelected()
    {
        $this->emit('cityToParent', $this->city);
    }


    public function render()
    {

        if (!empty($this->country)) {
            $country = Country::find($this->country);
            $this->divisions = Division::with(['locale'])->where('country_id', $this->country)->get();
            $this->cities = City::with(['locale'])->where('country_id', $this->country)->get();
        }

        $countries = Country::with(['locale'])->get();

        return view('livewire.locations.locations-dropdown', compact(['countries']));
    }
}
