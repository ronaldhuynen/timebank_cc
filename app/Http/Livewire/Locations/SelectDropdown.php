<?php

namespace App\Http\Livewire\Locations;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\District;
use Livewire\Component;

class SelectDropdown extends Component
{
    public $country = 1;
    public $cities = [];
    public $city = 305;
    public $districts = [];
    public $district;

    public function render()
    {
        if (!empty($this->country)) {
            $this->cities = City::where('country_id', $this->country)->orderBy('name')->get();
        }

        if (!empty($this->city)) {
            $this->districts = District::where('city_id', $this->city)->orderBy('name')->get();
        }

        return view('livewire.locations.select-dropdown')
            ->withCountries(Country::orderBy('name')->get());
    }
}

