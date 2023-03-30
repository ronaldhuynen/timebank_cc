<?php

namespace App\Models\Locations;

use App\Models\Locations\DistrictLocale;
use App\Models\User;
use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class District extends Model
{
// use LocationTrait;

    /**
     * The database table doesn't use 'created_at' and 'updated_at' so we disable it from Inserts/Updates.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'location_districts';



    public function locales()
    {
        return $this->hasMany(DistrictLocale::class, 'district_id');
       // 'distruct_id' as foreign key is needed as table name is not conventional
    }


    /**
     * Get all of the users of the districts.
     * Many-to-many polymorphic.
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'districtable', 'location_districtables');
        // districtable refers to pivot columns and location_districtables refers to pivot table
    }



    public function city()
    {
        $city = $this->belongsTo(City::class, 'city_id')->pluck('id');
        $country = $this->belongsTo(City::class, 'city_id')->pluck('country_id');
        $languages = DB::table('location_countries_languages')->where('country_id', $country)->pluck('code')->toArray();
        if (in_array(App::getLocale(), $languages)) {
            $languages = [App::getLocale()];
        }
        array_push($languages, App::getLocale());
        return CityLocale::where('city_id', $city)
            ->whereIn('locale', $languages)
            ->orderBy('name', 'ASC');
    }

    public function country()
    {
        $country = $this->belongsTo(City::class, 'city_id')->pluck('country_id');
        $languages = DB::table('location_countries_languages')->where('country_id', $country)->pluck('code')->toArray();
        if (in_array(App::getLocale(), $languages)) {
            $languages = [App::getLocale()];
        } else {
            $languages = [App::getFallbackLocale()];       // Use fallback locale (en) for country names instead of country languages
        }
        return CountryLocale::where('country_id', $country)
        ->whereIn('locale', $languages)
        ->orderBy('name', 'ASC');
    }

    public function division()
    {
        $division = $this->belongsTo(City::class, 'city_id')->pluck('division_id');
        $country = $this->belongsTo(City::class, 'city_id')->pluck('country_id');
        $languages = DB::table('location_countries_languages')->where('country_id', $country)->pluck('code')->toArray();
        if (in_array(App::getLocale(), $languages)) {
            $languages = [App::getLocale()];
        }
        array_push($languages, App::getLocale());
        return DivisionLocale::where('division_id', $division)
            ->whereIn('locale', $languages)
            ->orderBy('name', 'ASC');
    }

    public function parent()
    {
        if ($this->city() === null) {
            return $this->division();
        }
        return $this->city();
    }


    /**
     * Get District by name.
     *
     * @param string $name
     *
     * @return collection
     */
    public static function getByName($name)
    {
        $localed = District::where('name', $name)->first();
        return $localed->district;
    }

    /**
     * Search District by name.
     *
     * @param string $name
     *
     * @return collection
     */
    public static function searchByName($name)
    {
        return District::where('name', 'like', '%' . $name . '%')
            ->get()->map(function ($item) {
                return $item->district;
            });
    }
}
