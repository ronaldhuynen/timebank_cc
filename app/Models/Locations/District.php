<?php

namespace App\Models\Locations;

use App\Models\Locations\DistrictLocale;
use App\Models\User;
use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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
    }

    /**
    * Get all the local district names.
    * Using the preferred locale $this->languages().
    * @return void
    */
    public function name()
    {
        $result = $this->hasMany(DistrictLocale::class, 'district_id')
            ->whereIn('locale', [App::getLocale()]);
        if ($result->count() === 0) {
            $result = $this->hasMany(DistrictLocale::class, 'district_id')
                ->whereIn('locale',  [App::getFallbackLocale()]);
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
        return $this->morphedByMany(User::class, 'districtable', 'location_districtables');
    }


    public function city()
    {
        $city = $this->belongsTo(City::class, 'city_id')->pluck('id');
        $result = CityLocale::where('city_id', $city)
            ->whereIn('locale', [App::getLocale()])
            ->orderBy('name', 'ASC');
        if ($result->count() === 0) {
            $result = CityLocale::where('city_id', $city)
                ->whereIn('locale', [App::getFallbackLocale()])
                ->orderBy('name', 'ASC');
        }
        return $result;
    }

    public function country()
    {
        $country = $this->belongsTo(City::class, 'city_id')->pluck('country_id');
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
        $division = $this->belongsTo(City::class, 'city_id')->pluck('division_id');
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
