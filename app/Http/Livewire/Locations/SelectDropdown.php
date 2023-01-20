<?php

namespace App\Http\Livewire\Locations;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\District;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class SelectDropdown extends Component
{
    public $country = 1;
    public $cities = [];
    public $city = 305;
    public $districts = [];
    public $district;

    public function updatedCountry()
    {
       $this->reset('cities');
       $this->reset('city');
       $this->reset('districts');
       $this->reset('district');
    }

    public function updatedCity()
    {
       $this->reset('districts');
       $this->reset('district');
    }

    public function render()
    {
        if (!empty($this->country)) {

            $country = Country::find($this->country);
            $country_locale = strtolower($country->abbr);

            // OPLOSSING: In City model moest juiste foreign key genoemd worden vanwege onconventionele tafelnaam. ->with voor eager loading, ->join voor orderBy, gebruik CityLocale:: ipv City::
            $this->cities = City::with(['locales'])
                ->join('location_cities_locales', 'location_cities.id', '=', 'location_cities_locales.city_id')
                ->where([['country_id', $this->country],['location_cities_locales.locale', App::getLocale()]])
                ->orWhere([['country_id', $this->country], ['location_cities_locales.locale', $country_locale]])
                ->orderBy('location_cities_locales.name', 'ASC')
                ->get();

        }

        // Refactor into model method!
        // Country has a hasMany relation with CountryLocele, this returns another collection for the relations. But we only need one translation, so ->first()->name
        // Check fall-back methods! if user has russian query fails

        if (!empty($this->city)) {

            //TODO: Test met districts in meerdere talen!
            //TODO: Reset if city changes!
            $this->districts = District::with(['locales'])
                ->join('location_districts_locales', 'location_districts.id', '=', 'location_districts_locales.district_id')
                ->where([[ 'city_id', $this->city], ['location_districts_locales.locale', App::getLocale()]])
                ->orWhere([['city_id', $this->city], ['location_districts_locales.locale', $country_locale]])
                ->orderBy('location_districts_locales.name', 'ASC')
                ->get();

        }

        return view('livewire.locations.select-dropdown')
            ->withCountries(Country::with(['locales'])
                ->join('location_countries_locales', 'location_countries.id', '=', 'location_countries_locales.country_id')
                ->where('location_countries_locales.locale', App::getLocale())
                ->orderBy('location_countries_locales.name', 'ASC')
                ->get());
    }
}
