<?php

namespace App\Models\Locations;

use App\Models\User;
use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
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
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'location_countries';


    /**
     * Get an array of the preferred locales.
     * @return void
     */
    public function languages()
    {
        $country = $this->id;
        $languages = DB::table('location_countries_languages')->where('country_id', $country)->pluck('code')->toArray();
        if (in_array(App::getLocale(), $languages)) {
            $languages = [App::getLocale()];
        } else {
            $languages = [App::getFallbackLocale()];
        }
        array_push($languages, App::getLocale());
        return $languages;
    }


    /**
     * Return all available locales.
     *
     * @return void
     */
    public function locales()
    {
        return $this->hasMany(CountryLocale::class, 'country_id');
    }


    /**
     * Get all the local country names.
     * Using the preferred locale $this->languages().
     * @return void
     */
    public function name()
    {
        return $this->hasMany(CountryLocale::class, 'country_id')
            ->whereIn('locale', $this->languages())
            ->orderBy('name', 'ASC');
    }


    /**
     * Get all the users of the countries.
     * Many-to-many polymorphic.
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'countryable', 'location_countryables');
    }


    /**
     * Get all the divisions of the countries.
     * Using the preferred locale $this->languages().
     * @return void
     */
    public function divisions()
    {
        return $this->hasManyThrough(DivisionLocale::class, Division::class, 'country_id', 'division_id')
            ->whereIn('locale', $this->languages())
            ->orderBy('name', 'ASC');
    }


    /**
     * Get all the cities of the countries.
     * Using the preferred locale $this->languages().
     * @return void
     */
    public function cities()
    {
        return $this->hasManyThrough(CityLocale::class, City::class, 'country_id')
            ->whereIn('locale', $this->languages())
            ->orderBy('name', 'ASC');
    }


    /**
     * Get all the districts of the countries.
     * Only fallback locale is used when App language is not a country language of the city to prevent double results.
     *
     * @return void
     */
    public function districts()
    {
        return  $this->hasManyDeep(DistrictLocale::class, [City::class, District::class], ['country_id', 'city_id', 'district_id'], ['id', 'id', 'id'])
            ->whereIn('locale', $this->languages())
            ->orderBy('name', 'ASC');
    }


     /**
     * Get next level
     *
     * @return collection
     */
    public function children()
    {
        if ($this->division() == true) {
            return $this->divisions();
        }
        return $this->cities();
    }


    /**
     * Get country by name
     *
     * @param string $name
     * @return collection
     */
    public static function getByName($name)
    {
        $localized = CountryLocale::where('name', $name)->first();
        if (is_null($localized)) {
            return $localized;
        }
        return $localized->country;
    }

    /**
     * Search country by name
     *
     * @param string $name
     * @return collection
     */
    public static function searchByName($name)
    {
        return CountryLocale::where('name', 'like', "%" . $name . "%")
            ->get()->map(function ($item) {
                return $item->country;
            });
    }
}
