<?php

namespace App\Models\Locations;

use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class City extends Model
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
     * Many-to-many polymorphic.
     * @return void
     */
    public function users()
    {
        return $this->morphedByMany(Users::class, 'cityable', 'location_cityables');
        // cityable refers to pivot columns and location_cityables refers to pivot table
    }


    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Get next level
     *
     * @return collection
     */
    public function children()
    {
         return $this->district;
    }

    public function parent()
    {
        if ($this->division_id === null) {
            return $this->country;
        }
        return $this->division;
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
