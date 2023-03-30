<?php

namespace App\Models\Locations;


use App\Models\Locations\CityLocale;
use App\Models\Locations\DistrictLocale;
use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;


class City extends Model
{
// use LocationTrait;

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
    protected $table = 'location_cities';


    // HIERZO: REFACTOR DIT MODEL
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


    public function scope($query)
    {
        return $query->whereDate('created_at', \Carbon\Carbon::today());
    }


    /**
     * Return all available locales.
     *
     * @return void
     */
    public function locales()
    {
        return $this->hasMany(CityLocale::class, 'city_id');
    }


        /**
     * Get all the local division names.
     * Using the preferred locale $this->languages().
     * @return void
     */
    public function name()
    {
        return $this->hasMany(CityLocale::class, 'city_id')
            ->whereIn('locale', $this->languages())
            ->orderBy('name', 'ASC');
    }


    /**
     * Get all of the users of the cities.
     * Many-to-many polymorph
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(Users::class, 'cityable', 'location_cityables');
        // cityable refers to pivot columns and location_cityables refers to pivot table
    }


    /**
     * Get all the districts of the cities.
     * Including their local names and if possible the users application locale.
     * @return void
     */
    public function districts()
    {
        return $this->hasManyThrough(DistrictLocale::class, District::class, 'city_id', 'district_id')
            ->whereIn('locale', $this->languages())
            ->orderBy('name', 'ASC');
    }


    public function country()
    {
        $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        return CountryLocale::where('country_id', $country)
        ->whereIn('locale', $this->languages())
        ->orderBy('name', 'ASC');
    }

    public function division()
    {
        $division = $this->belongsTo(Division::class, 'division_id')->pluck('id');
        return DivisionLocale::where('division_id', $division)
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
         return $this->districts();
    }


    /**
     * Get prvious level
     *
     * @return void
     */
    public function parent()
    {
        if ($this->division() === null) {
            return $this->country();
        }
        return $this->division();
    }


    /**
     * Get City by name.
     *
     * @param string $name
     *
     * @return collection
     */
    public static function getByName($name)
    {
        $localed = CityLocale::where('name', $name)->first();
        if (is_null($localed)) {
            return $localed;
        }
        return $localed->city;
    }

    /**
     * Search City by name.
     *
     * @param string $name
     *
     * @return collection
     */
    public static function searchByName($name)
    {
        return CityLocale::where('name', 'like', '%' . $name . '%')
            ->get()->map(function ($item) {
                return $item->city;
            });
    }
}
