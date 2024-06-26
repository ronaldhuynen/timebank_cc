<?php

namespace App\Models\Locations;

use App\Models\Category;
use App\Models\Locations\CityLocale;
use App\Models\Locations\Country;
use App\Models\Locations\DistrictLocale;
use App\Models\Locations\Division;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class City extends Model
{
    use HasRelationships;
    use HasFactory;

    /**
     * The database table doesn't use 'created_at' and 'updated_at' so we disable it from Inserts/Updates.
     *
     * @var bool
     */
    public $timestamps = false;


    /**
    * Return all available locales of the city.
    *
    * @return void
    */
    public function translations()
    {
        return $this->hasMany(CityLocale::class, 'city_id');
    }



    /**
     * Get all of the users of the cities.
     * Many-to-many polymorph
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'cityable', 'cityables');
        // cityable refers to pivot columns and cityables refers to pivot table
    }

    /**
     * Get all of the cityables of the cities.
     * Many-to-many polymorph
     * @return void
     */
    public function cityables()
    {
        return $this->morphedByMany(City::class, 'cityable', 'cityables');
        // cityable refers to pivot columns and cityables refers to pivot table
    }



    /**
     * Get all of the organizations of the cities.
     * Many-to-many polymorph
     * @return void
     */
    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'cityable');
        // cityable refers to pivot columns and cityables refers to pivot table
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
     * Get all related locations of the division.
     * One-to-many.
     * @return void
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
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
        // $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        // $result = CountryLocale::where('country_id', $country)
        //     ->where('locale', App::getLocale());
        // if ($result->count() === 0) {
        //     $result = CountryLocale::where('country_id', $country)
        //         ->where('locale', App::getFallbackLocale());
        // }
        // return $result;
        return $this->belongsTo(Country::class);
    }


    /**
     * Get the division of the city in the App::getLocale, or if not exists, in the App::getFallbackLocale language.
     *
     * @return void
     */
    public function division()
    {
        // $division = $this->belongsTo(Division::class, 'division_id')->pluck('id');
        // $result = DivisionLocale::where('division_id', $division)
        //     ->where('locale', App::getLocale());
        // if ($result->count() === 0) {
        //     $result = DivisionLocale::where('division_id', $division)
        //             ->where('locale', App::getFallbackLocale());
        //     }
        // return $result;
        return $this->belongsTo(Division::class);
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


    /**
     * Get all of the related categories for this model.
     */
    public function categories()
    {
        return $this->morphMany(Category::class, 'categoryable');
    }

}
