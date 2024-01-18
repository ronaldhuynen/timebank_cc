<?php

namespace App\Models\Locations;

use App\Models\Category;
use App\Models\Locations\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Country extends Model
{
    use HasRelationships;

    /**
     * The database table doesn't use 'created_at' and 'updated_at' so we disable it from Inserts/Updates.
     *
     * @var bool
     */
    public $timestamps = false;


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
     * Return all related locales.
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(CountryLocale::class, 'country_id');
    }


    public function translationExists()
    {
        return $this->hasOne(CountryLocale::class, 'country_id')->where('locale', App::getLocale())->exists();
    }


    /**
     * Get all the users of the countries.
     * Many-to-many polymorphic.
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'countryable', 'countryables');
    }


    /**
     * Get all the related divisions of the country.
     * @return void
     */
    public function divisionsRelation()
    {
        return $this->hasManyThrough(DivisionLocale::class, Division::class, 'country_id', 'division_id');
    }


    /**
     * Get the divisions of the country.
     * One-to-many
     * @param string 
     * @return void
     */
    public function divisions()
    {
        return $this->hasMany(Division::class);
    }


    /**
    * Get all the related cities of the country.
    * @return void
    */
    public function cities()
    {
        return $this->hasManyThrough(CityLocale::class, City::class, 'country_id');
    }


    /**
     * Get the related cities locale of the country in the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     * The optional property will filter the localized city names.
     * @return void
     */
    public function citiesLocale(string $search = '')
    {
        $locale = collect(
            $this->hasManyThrough(CityLocale::class, City::class, 'country_id')
                ->where('locale', App::getLocale())
                ->get()
        )->keyBy('city_id');

        $fallback = collect(
            $this->hasManyThrough(CityLocale::class, City::class, 'country_id')
                ->where('locale', App::getFallbackLocale())
                ->get()
        )->keyBy('city_id');

        $result = $locale
            ->union($fallback)
            ->filter(function ($item) use ($search) {
                return false !== stripos($item->name, $search);
            })
            ->sortBy('name');

        return $result;
    }



    /**
    * Get all the related districts of the country.
    *
    * @return void
    */
    public function districtsRelation()
    {
        return $this->hasManyDeep(DistrictLocale::class, [City::class, District::class], ['country_id', 'city_id', 'district_id'], ['id', 'id', 'id']);
    }


    /**
     * Get all the districts of the countries.
     * Only fallback locale is used when App language is not a country language of the city to prevent double results.
     *
     * @return void
     */
    public function districts(string $search = '')
    {
        $locale = collect(
            $this->hasManyDeep(DistrictLocale::class, [City::class, District::class], ['country_id', 'city_id', 'district_id'], ['id', 'id', 'id'])
                ->where('locale', App::getLocale())
                ->get()
        )->keyBy('district_id');

        $fallback = collect(
            $this->hasManyDeep(DistrictLocale::class, [City::class, District::class], ['country_id', 'city_id', 'district_id'], ['id', 'id', 'id'])
                ->where('locale', App::getFallbackLocale())
                ->get()
        )->keyBy('district_id');

        $result = $locale
            ->union($fallback)
            ->filter(function ($item) use ($search) {
                return false !== stripos($item->name, $search);
            })
            ->sortBy('name');

        return $result;
    }


     /**
     * Get the related children of this model.
     *
     * @return collection
     */
    public function children(string $search = '')
    {
        if ($this->divisions() == true) {
            return $this->divisions($search);
        }
        return $this->cities($search);
    }

    
    /**
     * Get all of the related categories for this model.
     */
    public function categories()
    {
        return $this->morphMany(Category::class, 'categoryable');
    }

}
