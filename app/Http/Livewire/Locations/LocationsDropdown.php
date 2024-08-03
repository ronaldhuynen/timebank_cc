<?php

namespace App\Http\Livewire\Locations;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\District;
use App\Models\Locations\Division;
use Livewire\Component;

class LocationsDropdown extends Component
{
    public $country;
    public $divisions = [];
    public $division;
    public $cities = [];
    public $city;
    public $districts = [];
    public $district;

    protected $listeners = ['countryToChildren', 'divisionToChildren', 'cityToChildren', 'districtToChildren'];


    public function countryToChildren($value)
    {
        $this->country = $value;
        $this->updatedCountry();
    }


    public function divisionToChildren($value)
    {
        $this->division = $value;
        $this->updatedDivision();
    }


    public function cityToChildren($value)
    {
        $this->city = $value;
        $this->updatedCity();
    }


    public function districtToChildren($value)
    {
        $this->district = $value;
        $this->updatedDistrict();
    }


    public function updatedCountry()
    {
        $this->reset(['division', 'divisions']);
        $this->reset(['city', 'cities']);
        $this->reset(['district', 'districts']);

        $this->dispatch('countryToParent', $this->country);
        $this->dispatch('divisionToParent', $this->division);
        $this->dispatch('cityToParent', $this->city);
        $this->dispatch('districtToParent', $this->district);
    }


    public function updatedDivision()
    {
        $this->reset(['city', 'cities']);
        $this->reset(['district', 'districts']);
        if ($this->division === '') {
            $this->division = null;
        }
        $this->dispatch('divisionToParent', $this->division);
        $this->dispatch('cityToParent', $this->city);
        $this->dispatch('districtToParent', $this->district);
    }


    public function updatedCity()
    {
        $this->reset(['district', 'districts']);
        if ($this->city === '') {
            $this->city = null;
        }
        $this->dispatch('cityToParent', $this->city);
        $this->dispatch('districtToParent', $this->district);
    }


    public function updatedDistrict()
    {
        if ($this->district === '') {
            $this->district = null;
        }
        $this->dispatch('districtToParent', $this->district);
    }


    public function countrySelected()
    {
        $this->dispatch('countryToParent', $this->country);
    }


    public function divisionSelected()
    {
        $this->dispatch('divisionToParent', $this->division);
    }


    public function citySelected()
    {
        $this->dispatch('cityToParent', $this->city);
    }


    public function districtSelected()
    {
        $this->dispatch('districtToParent', $this->district);
    }


    public function render()
    {

        if (!empty($this->country)) {
            $country = Country::find($this->country);
            $this->divisions = Division::with(['translations'])->where('country_id', $this->country)->get();
            $this->cities = City::with(['translations'])->where('country_id', $this->country)->get();
        }

        if (!empty($this->city)) {
            $this->districts = District::with(['translations'])->where('city_id', $this->city)->get();
        }

        $countries = Country::with(['translations'])->get();

        return view('livewire.locations.locations-dropdown', compact(['countries']));
    }
}
