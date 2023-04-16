<?php

namespace App\Http\Livewire\Locations;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use Livewire\Component;

class LocationsDropdown extends Component
{
    public $country;
    public $cities = [];
    public $city;

    protected $listeners = ['countryToChildren', 'cityToChildren'];


    public function countryToChildren($value)
    {
        $this->country = $value;
    }

    public function cityToChildren($value)
    {
        $this->city = $value;
    }


    public function updatedCountry()
    {
        $this->reset(['city', 'cities']);
    }


    public function countrySelected()
    {
        $this->emit('countryToParent', $this->country);
    }


    public function citySelected()
    {
        $this->emit('cityToParent', $this->city);
    }


    public function render()
    {
        // $this->citySelected();
        // $this->emit('countryToParent', $this->country);

        if (!empty($this->country)) {
            $country = Country::find($this->country);
            // $country_locale = strtolower($country->code);
            $this->cities = City::with(['locale'])->where('country_id', $this->country)->get();
        }

        $countries = Country::with(['locale'])->get();

        return view('livewire.locations.locations-dropdown', compact(['countries']));
    }
}
