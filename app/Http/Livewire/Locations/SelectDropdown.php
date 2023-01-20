<?php

namespace App\Http\Livewire\Locations;

use App\Models\Locations\City;
use App\Models\Locations\CityLocale;
use App\Models\Locations\Country;
use App\Models\Locations\District;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class SelectDropdown extends Component
{
    public $country;
    public $cities = [];
    public $city;
    public $districts = [];
    public $district;


    public function render()
    {
        if (!empty($this->country)) {

            $country = Country::find($this->country);
            $country_locale = strtolower($country->abbr);

            // OPLOSSING: In City model moest juiste foreign key genoemd worden vanwege onconventionele tafelnaam. ->with voor eager loading, ->join voor orderBy, gebruik CityLocale:: ipv City::
            $this->cities = City::with(['locales'])
                ->join('location_cities_locales', 'location_cities.id', '=', 'location_cities_locales.city_id')
                ->where('country_id', $this->country)
                ->where('location_cities_locales.locale', App::getLocale())
                ->orWhere('location_cities_locales.locale', $country_locale)
                ->orderBy('location_cities_locales.name', 'ASC')
                ->get();

        }


        // Refactor into model method!
        // Country has a hasMany relation with CountryLocele, this returns another collection for the relations. But we only need one translation, so ->first()->name
        // Check fall-back methods! if user has russian query fails

        // $r = Country::with(['locales' => function ($query) {
        //     $query->where('locale', App::getLocale());
        //     }])->get();


        // foreach ($r as $i) {
        // echo "{$i->locales->first()->name }<br>";
        // }

        if (!empty($this->city)) {
            $this->districts = District::with('locales')->where('city_id', $this->city)
                ->whereHas('locales', function ($query) {
                    $query->where('locale', App::getLocale());
                })->get();
        }

        return view('livewire.locations.select-dropdown')
            ->withCountries(
                Country::with(['locales' => function ($query) {
                    $query->where('locale', App::getLocale());
                }])->get()
            );
    }
}
