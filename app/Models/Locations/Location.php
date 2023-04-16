<?php

namespace App\Models\Locations;

use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\District;
use App\Models\Locations\Division;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
    * Return all related countries.
    * Many-to-many polymorphic.
    * @return void
    */
    public function countries()
    {
        return $this->morphToMany(Country::class, 'countryable');
    }


    /**
    * Return all related divisions.
    * Many-to-many polymorphic.
    * @return void
    */
    public function divisions()
    {
        return $this->morphToMany(Division::class, 'divisionable');
    }


    /**
    * Return all related cities.
    * Many-to-many polymorphic.
    * @return void
    */
    public function cities()
    {
        return $this->morphToMany(City::class, 'cityable');
    }


    /**
    * Return all related districts.
    * Many-to-many polymorphic.
    * @return void
    */
    public function districts()
    {
        return $this->morphToMany(District::class, 'districtable');
    }


        /**
    * Return all related countries.
    * Many-to-many polymorphic.
    * @return void
    */
    public function users()
    {
        return $this->morphedByMany(User::class, 'locationable');
    }

}
