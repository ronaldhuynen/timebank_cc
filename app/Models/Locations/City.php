<?php

namespace App\Models\Locations;


use App\Models\Locations\CityLocale;
use App\Models\Locations\DistrictLocale;
use App\Models\User;
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
    * Return all available locales of the city.
    *
    * @return void
    */
    public function locales()
    {
        return $this->hasMany(CityLocale::class, 'city_id');
    }


    /**
    * Get the city locale.
    * In the App::getLocale, or if not exists, in the App::getFallbackLocale language.
    * @return void
    */
    public function locale()
    {
        return $this->hasOne(CityLocale::class, 'city_id')
        ->where('locale', App::getLocale())
        ->orWhere('locale', App::getFallbackLocale())
        ->orderByRaw("CASE WHEN `locale` = ? THEN 2 ELSE 1 END ASC", App::getFallbackLocale());
    }


    /**
     * Get all of the users of the cities.
     * Many-to-many polymorph
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'cityable', 'location_cityables');
        // cityable refers to pivot columns and location_cityables refers to pivot table
    }



    /**
     * Get all of the organisations of the cities.
     * Many-to-many polymorph
     * @return void
     */
    public function organisations()
    {
        return $this->morphedByMany(Organisation::class, 'cityable', 'location_cityables');
        // cityable refers to pivot columns and location_cityables refers to pivot table
    }



    /**
     * Get all the related districts of the city.
     * @return void
     */
    public function districtsRelation()
    {
        return $this->hasManyThrough(DistrictLocale::class, District::class, 'city_id', 'district_id');
    }


    /**
     * Get the districst of the city in the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     * The optional paramameter will filter the localized district names.
     * @param string $search
     * @return void
     */
    public function districts(string $search = '')
    {
        $locale = collect(
            $this->hasManyThrough(DistrictLocale::class, District::class, 'city_id', 'district_id')
                    ->where('locale', App::getLocale())
                    ->get()
        )->keyBy('district_id');

        $fallback = collect(
            $this->hasManyThrough(DistrictLocale::class, District::class, 'city_id', 'district_id')
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
     * Get the country of the city in the App::getLocale, or if not exists, in the App::getFallbackLocale language.
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
     * Get the division of the city in the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     *
     * @return void
     */
    public function division()
    {
        $division = $this->belongsTo(Division::class, 'division_id')->pluck('id');
        $result = DivisionLocale::where('division_id', $division)
            ->where('locale', App::getLocale());
        if ($result->count() === 0) {
            $result = DivisionLocale::where('division_id', $division)
                    ->where('locale', App::getFallbackLocale());
            }
        return $result;
    }

    /**
     * Get the related children of this model.
     *
     * @return collection
     */
    public function children($search = '')
    {
         return $this->districts($search);
    }


    /**
     * Get the related parent of this model.
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

}
