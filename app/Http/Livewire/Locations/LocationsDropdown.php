<?php

namespace App\Http\Livewire\Locations;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\District;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Stevebauman\Location\Facades\Location as IpLocation;

class LocationsDropdown extends Component
{
    public $country;
    public $cities = [];
    public $city;
    public $districts = [];
    public $district;


    public function mount(Request $request)
    {
        if (App::environment(['local', 'staging'])) {
            // $ip = '103.75.231.255'; // Static IP address Brussels for testing
            $ip = '31.20.250.12'; // Statis IP address The Hague for testing
            // $ip = '102.129.156.0'; // Statis IP address Berlin for testing
        } else {
            $ip = $request->ip(); // Dynamic IP address
        }
        $IpLocationInfo = IpLocation::get($ip);
        if ($IpLocationInfo) {

            $country = Country::select('id')->where('code', $IpLocationInfo->countryCode)->first();
            if ($country) {
                $this->country = $country->id;
            }

            $city = DB::table('location_cities_locales')->select('city_id')->where('name', $IpLocationInfo->cityName)->where('locale', 'en')->first();
            if ($city) {
                $this->city = $city->city_id;
            };
        }
    }


    public function updatedCountry()
    {
        $this->reset(['district', 'districts', 'city', 'cities']);
    }


    public function updatedCity()
    {
        $this->reset(['district', 'districts']);
    }


    public function countrySelected()
    {
        $this->emit('countryToParent', $this->country);
    }


    public function citySelected()
    {
        $this->emit('cityToParent', $this->city);
    }


    public function districtSelected()
    {
        $this->emit('districtToParent', $this->district);
    }


    public function render()
    {
        if (!empty($this->country)) {
            $country = Country::find($this->country);
            $country_locale = strtolower($country->code);

            // OPLOSSING: In City model moest juiste foreign key genoemd worden vanwege onconventionele tafelnaam. ->with voor eager loading, ->join voor orderBy, gebruik CityLocale:: ipv City::
            // $this->cities = City::with(['locales'])
            //     ->join('location_cities_locales', 'location_cities.id', '=', 'location_cities_locales.city_id')
            //     ->where([['country_id', $this->country],['location_cities_locales.locale', App::getLocale()]])
            //     ->orWhere([['country_id', $this->country], ['location_cities_locales.locale', $country_locale]])
            //     ->orderBy('location_cities_locales.name', 'ASC')
            //     ->get();

            $this->cities = City::with(['locale'])->where('country_id', $this->country)->get();
        }

        // Refactor into model method!
        // Country has a hasMany relation with CountryLocele, this returns another collection for the relations. But we only need one translation, so ->first()->name
        // Check fall-back methods! if user has russian query fails

        if (!empty($this->city)) {
            //TODO: Test met districts in meerdere talen!
            $this->districts = District::with(['locales'])
                ->join('location_districts_locales', 'location_districts.id', '=', 'location_districts_locales.district_id')
                ->where([[ 'city_id', $this->city], ['location_districts_locales.locale', App::getLocale()]])
                ->orWhere([['city_id', $this->city], ['location_districts_locales.locale', $country_locale]])
                ->orderBy('location_districts_locales.name', 'ASC')
                ->get();
        }

        $countries = Country::with(['locale'])->get();

        return view('livewire.locations.locations-dropdown', compact(['countries']));
    }
}
