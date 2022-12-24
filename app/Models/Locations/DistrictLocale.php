<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;

class DistrictLocale extends Model
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
    protected $table = 'location_districts_locales';

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
