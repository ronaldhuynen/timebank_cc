<?php

namespace App\Model\Locations;

use Illuminate\Database\Eloquent\Model;

class DivisionLocale extends Model
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
    protected $table = 'location_divisions_locale';

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    }
