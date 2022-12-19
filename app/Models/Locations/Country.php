<?php

namespace App\Models\Locations;

use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
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
    protected $table = 'location_countries';


    /**
     * append names
     *
     * @var array
     */
    protected $appends = ['local_name','local_full_name','local_alias', 'local_abbr'];

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }


    /**
     * Get next level
     *
     * @return collection
     */
    public function children()
    {
        if ($this->has_division == true) {
            return $this->divisions;
        }
        return $this->cities;
    }


    public function locales()
    {
        return $this->hasMany(CountryLocale::class);
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
