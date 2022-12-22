<?php

namespace App\Http\Livewire\Locations;

use App\Models\Locations\City;
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
            $this->cities = City::with('locales')->where('country_id', $this->country)
                ->whereHas('locales', function ($query) {
                    $query->where('locale', 'nl');
                })->get();
        }


        // Refactor into model method!
        // Country has a hasMany relation with CountryLocele, this returns another collection for the relations. But we only need one translation, so ->first()->name
        // Check fall-back methods! if user has russian query fails

        $r = Country::with(['locales' => function ($query) {
            $query->where('locale', App::getLocale());
            }])->get();


        foreach ($r as $i) {
        echo "{$i->locales->first()->name }<br>";
        }

        if (!empty($this->city)) {
            $this->districts = District::where('city_id', $this->city)->get();
        }

        return view('livewire.locations.select-dropdown')
            ->withCountries(
                Country::with(['locales' => function ($query) {
                    $query->where('locale',  App::getLocale());
                }])->get());

    }
}
