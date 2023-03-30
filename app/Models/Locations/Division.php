<?php

namespace App\Models\Locations;

use App\Models\Locations\DivisionLocale;
use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Division extends Model
{
    use LocationTrait;

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
     * Get an array of the preferred locales.
     * @return void
     */
    public function languages()
    {
        $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        $languages = DB::table('location_countries_languages')->where('country_id', $country)->pluck('code')->toArray();
        if (in_array(App::getLocale(), $languages)) {
            $languages = [App::getLocale()];
        } else {
            $languages = [App::getFallbackLocale()];
        }
        array_push($languages, App::getLocale());
        return $languages;
    }


    public function locales()
    {
        return $this->hasMany(DivisionLocale::class, 'division_id');
        // 'division_id' as foreign key is needed as table name is not conventional
    }


    /**
     * Get all of the users of the divisions.
     * Many-to-many polymorphic.
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(Users::class, 'divisionable', 'location_divisionables');
        // divisionable refers to pivot columns and location_divisionables refers to pivot table
    }



    /**
     * Get the countries of the divisions.
     *
     * @return void
     */
    public function country()
    {
        $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        return CountryLocale::where('country_id', $country)
        ->whereIn('locale', $this->languages())
        ->orderBy('name', 'ASC');
    }

    /**
     * Get all the cities of the divisions.
     * @return void
     */
    public function cities()
    {
        return $this->hasManyThrough(CityLocale::class, City::class, 'division_id', 'city_id')
            ->whereIn('locale', $this->languages())
            ->orderBy('name', 'ASC');
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
