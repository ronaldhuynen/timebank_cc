<?php

namespace App\Models\Locations;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\District;
use App\Models\Locations\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_id', 'division_id', 'city_id', 'district_id'];

    /**
    * Return related country.
    * one-to-many
    * @return void
    */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    /**
    * Return all related divisions.
    * One-to-many
    * @return void
    */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }


    /**
    * Return related city.
    * One-to-many
    * @return void
    */
    public function city()
    {
        return $this->belongsTo(City::class);
    }


    /**
    * Return related district.
    * One-to-many
    * @return void
    */
    public function district()
    {
        return $this->belongsTo(District::class);
    }


    /**
    * Return related locatable (i.e. user or organization).
    * One-to-many polymorph
    * @return void
    */
    public function locatable()
    {
        return $this->morphTo();
    }

}
