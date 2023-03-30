<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;

class Citylocale extends Model
{
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
    protected $table = 'location_cities_locales';


    /**
     * return belonged City
     *
     * @return void
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
