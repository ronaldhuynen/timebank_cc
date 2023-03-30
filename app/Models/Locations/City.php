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

    /**
     * append names.
     *
     * @var array
     */
    // protected $appends = ['local_name', 'local_alias', 'local_full_name'];


    // Always eager load this model with:
    // protected $with = ['locales'];
    public function locales()
    {
        return $this->hasMany(CityLocale::class, 'city_id');
       // 'city_id' as foreign key is needed as table name is not conventional
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
        $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        $languages = DB::table('location_countries_languages')->where('country_id', $country)->pluck('code')->toArray();
        if (in_array(App::getLocale(), $languages)) {
            $languages = [App::getLocale()];
        }
        array_push($languages, App::getLocale());
        return $this->hasManyThrough(DistrictLocale::class, District::class, 'city_id', 'district_id')
            ->whereIn('locale', $languages)
            ->orderBy('name', 'ASC');
    }


    public function country()
    {
        $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        $languages = DB::table('location_countries_languages')->where('country_id', $country)->pluck('code')->toArray();
        if (in_array(App::getLocale(), $languages)) {
            $languages = [App::getLocale()];
        } else {
            $languages = [App::getFallbackLocale()];       // Use fallback locale (en) for country names instead of country languages
        }
        return CountryLocale::where('country_id', $country)
        ->whereIn('locale', $languages)
        ->orderBy('name', 'ASC');
    }

    public function division()
    {
        $division = $this->belongsTo(Division::class, 'division_id')->pluck('id');
        $country = $this->belongsTo(Country::class, 'country_id')->pluck('id');
        $languages = DB::table('location_countries_languages')->where('country_id', $country)->pluck('code')->toArray();
        if (in_array(App::getLocale(), $languages)) {
            $languages = [App::getLocale()];
        }
        array_push($languages, App::getLocale());
        return DivisionLocale::where('division_id', $division)
        ->whereIn('locale', $languages)
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
