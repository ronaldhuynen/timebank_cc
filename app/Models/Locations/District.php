<?php

namespace App\Models\Locations;

use App\Models\Category;
use App\Models\Locations\DistrictLocale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class District extends Model
{
    /**
     * The database table doesn't use 'created_at' and 'updated_at' so we disable it from Inserts/Updates.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Accessor:
     * Get the district locale.
     * In the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getLocaleAttribute()
    {
        return $this->hasMany(DistrictLocale::class)
            ->where(function ($query) {
                $query->where('locale', App::getLocale())
                    ->orWhere('locale', App::getFallbackLocale());
            })
            ->orderByRaw("(CASE WHEN locale = ? THEN 1 WHEN locale = ? THEN 2 END)", [App::getLocale(), App::getFallbackLocale()])
            ->first();
    }


    /**
    * Return all available locales of the district.
    *
    * @return void
    */
    public function translations()
    {
        return $this->hasMany(DistrictLocale::class, 'district_id');
    }


    /**
    * Get the local district name.
    * In the App::getLocale, or if not exists, in the App::getFallbackLocale language.
    * @return void
    */
    public function name()
    {
        $result = $this->hasMany(DistrictLocale::class, 'district_id')
            ->where('locale', App::getLocale());
        if ($result->count() === 0) {
            $result = $this->hasMany(DistrictLocale::class, 'district_id')
                ->where('locale', App::getFallbackLocale());
        }
        return $result;
    }


    /**
     * Get all of the users of the districts.
     * Many-to-many polymorphic.
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'districtable', 'districtables');
    }


    /**
     * Get all related locations of the division.
     * One-to-many.
     * @return void
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }


    /**
    * Get the related city of the district.
    * In the App::getLocale, or if not exists, in the App::getFallbackLocale language.
    * @return void
    */
    public function city()
    {
        $city = $this->belongsTo(City::class, 'city_id')->pluck('id');
        $result = CityLocale::where('city_id', $city)
            ->where('locale', App::getLocale());
        if ($result->count() === 0) {
            $result = CityLocale::where('city_id', $city)
                ->where('locale', App::getFallbackLocale());
        }
        return $result;
    }



    /**
    * Get the related country of the district.
    * In the App::getLocale, or if not exists, in the App::getFallbackLocale language.
    * @return void
    */
    public function country()
    {
        $country = $this->belongsTo(City::class, 'city_id')->pluck('country_id');
        $result = CountryLocale::where('country_id', $country)
            ->where('locale', App::getLocale());
        if ($result->count() === 0) {
            $result = CountryLocale::where('country_id', $country)
                ->where('locale', App::getFallbackLocale());
        }
        return $result;
    }


    /**
    * Get the related division of the district.
    * In the App::getLocale, or if not exists, in the App::getFallbackLocale language.
    * @return void
    */
    public function division()
    {
        $division = $this->belongsTo(City::class, 'city_id')->pluck('division_id');
        $result = DivisionLocale::where('division_id', $division)
            ->where('locale', App::getLocale());
        if ($result->count() === 0) {
            $result = DivisionLocale::where('division_id', $division)
                ->where('locale', App::getFallbackLocale());
        }
        return $result;
    }


    /**
     * Get the related parent of this model.
     *
     * @return void
     */
    public function parent()
    {
        if ($this->city() === null) {
            return $this->division();
        }
        return $this->city();
    }


    /**
     * Get all of the related categories for this model.
     */
    public function categories()
    {
        return $this->morphMany(Category::class, 'categoryable');
    }

}
