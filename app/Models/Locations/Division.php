<?php

namespace App\Models\Locations;

use App\Models\Category;
use App\Models\Locations\City;
use App\Models\Locations\DivisionLocale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Division extends Model
{
    // use LocationTrait;

    /**
     * The database table doesn't use 'created_at' and 'updated_at' so we disable it from Inserts/Updates.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
     * Return all available locales of the division.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(DivisionLocale::class, 'division_id');
    }


    /**
     * Get the local division name.
     * In the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     * @return void
     */
    public function name()
    {
        $result = $this->hasMany(DivisionLocale::class, 'division_id')
            ->whereIn('locale', [App::getLocale()]);
        if ($result->count() === 0) {
            $result = $this->hasMany(DivisionLocale::class, 'division_id')
                ->whereIn('locale', [App::getFallbackLocale()]);
        }
        return $result;
    }


    /**
     * Get all of the users of the division.
     * Many-to-many polymorphic.
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(Users::class, 'divisionable', 'divisionables');
    }


    /**
     * Get the related country of the division.
     *
     * @return void
     */
    public function countryRelation()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }


    /**
     * Get the country of the division in the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     *
     * @return void
     */
    public function country()
    {
        $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        $result = CountryLocale::where('country_id', $country)
            ->where('locale', App::getLocale());
        if ($result->count() === 0) {
            $result = CountryLocale::where('country_id', $country)
                ->where('locale', App::getFallbackLocale());
        }
        return $result;
    }


    /**
     * Get all the related cities of the division.
     * @return void
     */
    public function citiesRelation()
    {
        return $this->hasManyThrough(CityLocale::class, City::class, 'division_id', 'city_id');
    }


    /**
     * Get the cities of the division in the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     * The optional paramameter will filter the localized city names.
     * @param string $search
     * @return void
     */
    public function cities()
    {
    // {
    //     $locale = collect(
    //         $this->hasManyThrough(CityLocale::class, City::class, 'division_id', 'city_id')
    //         ->where('locale', App::getLocale())
    //         ->get()
    //         )->keyBy('city_id');

    //     $fallback = collect(
    //         $this->hasManyThrough(CityLocale::class, City::class, 'division_id', 'city_id')
    //         ->where('locale', App::getFallbackLocale())
    //         ->get()
    //         )->keyBy('city_id');

    //     $result = $locale
    //         ->union($fallback)
    //         ->filter(function ($item) use ($search){
    //             return false !== stripos($item->name, $search);
    //         })
    //         ->sortBy('name');

    //     return $result;

        return $this->hasMany(City::class);
    }


    /**
     * Get the related children of this model.
     *
     * @param  string $search
     * @return void
     */
    public function children(string $search = '')
    {
        return $this->cities($search);
    }


    /**
     * Get the related parent of this model.
     *
     * @return void
     */
    public function parent()
    {
        return $this->country();
    }

    
    /**
     * Get all of the related categories for this model.
     */
    public function categories()
    {
        return $this->morphMany(Category::class, 'categoryable');
    }

}
