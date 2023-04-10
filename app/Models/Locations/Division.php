<?php

namespace App\Models\Locations;

use App\Models\Locations\DivisionLocale;
use App\Traits\LocationTrait;
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
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'location_divisions';


    /**
     * Return all available locales.
     *
     * @return void
     */
    public function locales()
    {
        return $this->hasMany(DivisionLocale::class, 'division_id');
    }


    /**
     * Get all the local division names.
     * Using the preferred locale $this->languages().
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
     * Get all of the users of the divisions.
     * Many-to-many polymorphic.
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(Users::class, 'divisionable', 'location_divisionables');
    }



    /**
     * Get the countries of the divisions.
     *
     * @return void
     */
    public function country()
    {
        $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        $result = CountryLocale::where('country_id', $country)
            ->whereIn('locale', [App::getLocale()])
            ->orderBy('name', 'ASC');
        if ($result->count() === 0) {
            $result = CountryLocale::where('country_id', $country)
                ->whereIn('locale', [App::getFallbackLocale()])
                ->orderBy('name', 'ASC');
        }
        return $result;
    }


    /**
     * Get all the cities of the divisions.
     * @return void
     */
    public function cities()
    {
        $result = $this->hasManyThrough(CityLocale::class, City::class, 'division_id', 'city_id');

        return $result;
    }


    /**
     * Get the cities of the divisions in the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     * The optional paramameter will filter the localized city names.
     * @param  mixed $search
     * @return void
     */
    public function citiesLocale($search = '')
    {
        $locale = collect(
                    $this->hasManyThrough(CityLocale::class, City::class, 'division_id', 'city_id')
                    ->where('locale', App::getLocale())
                    ->get()
                    )->keyBy('city_id');

                    $fallback = collect(
                    $this->hasManyThrough(CityLocale::class, City::class, 'division_id', 'city_id')
                    ->where('locale', App::getFallbackLocale())
                    ->get()
                    )->keyBy('city_id');

                    $result = $locale
                    ->union($fallback)
                    ->filter(function ($item) use ($search){
                        return false !== stripos($item->name, $search);
                    })
                    ->sortBy('name');

        return $result;
    }


    public function children()
    {
        return $this->cities();
    }


    public function parent()
    {
        return $this->country();
    }


    /**
     * Get Division by name
     *
     * @param string $name
     * @return collection
     */
    public static function getByName($name)
    {
        $localized = DivisionLocale::where('name', $name)->first();
        if (is_null($localized)) {
            return $localized;
        }
        return $localized->division;
    }

    /**
     * Search Division by name
     *
     * @param string $name
     * @return collection
     */
    public static function searchByName($name)
    {
        return DivisionLocale::where('name', 'like', "%" . $name . "%")
            ->get()->map(function ($item) {
                return $item->division;
            });
    }
}
