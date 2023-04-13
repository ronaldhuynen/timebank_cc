<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class CountryLocale extends Model
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
    protected $table = 'location_countries_locales';


    protected static function booted()
    {
        static::addGlobalScope(fn ($query) => $query->orderBy('name'));
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
