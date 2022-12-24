<?php

namespace App\Models\Locations;

use App\Models\Locations\DistrictLocale;
use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;

class District extends Model
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
    protected $table = 'location_districts';

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function children()
    {
        return null;
    }

    public function parent()
    {
        if ($this->city_id === null) {
            return $this->division;
        }
        return $this->city;
    }

    public function locales()
    {
        return $this->hasMany(DistrictLocale::class);
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
