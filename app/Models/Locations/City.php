<?php

namespace App\Models\Locations;


use App\Models\Locations\CityLocale;
use App\Models\Locations\DistrictLocale;
use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;


class City extends Model
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
    protected $table = 'location_cities';


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
    * Get all the local city names.
    * Using the preferred locale $this->languages().
    * @return void
    */
    public function name()
    {
        $result = $this->hasMany(CityLocale::class, 'city_id')
            ->whereIn('locale', [App::getLocale()]);
        if ($result->count() === 0) {
        $result = $this->hasMany(CityLocale::class, 'city_id')
        ->whereIn('locale', [App::getFallbackLocale()]);
        }
        return $result;
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
        $result = $this->hasManyThrough(DistrictLocale::class, District::class, 'city_id', 'district_id')
            ->whereIn('locale', [App::getLocale()])
            ->orderBy('name', 'ASC');
        if ($result->count() === 0)  {
            $result = $this->hasManyThrough(DistrictLocale::class, District::class, 'city_id', 'district_id')
            ->whereIn('locale', [App::getFallbackLocale()])
            ->orderBy('name', 'ASC');
        }
        return $result;
    }


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

    public function division()
    {
        $division = $this->belongsTo(Division::class, 'division_id')->pluck('id');
        $result = DivisionLocale::where('division_id', $division)
            ->whereIn('locale', [App::getLocale()])
            ->orderBy('name', 'ASC');
        if ($result->count() === 0) {
            $result = DivisionLocale::where('division_id', $division)
                    ->whereIn('locale', [App::getFallbackLocale()])
                    ->orderBy('name', 'ASC');
        }
        return $result;
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
