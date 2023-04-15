<?php

namespace App\Models\Locations;

use Illuminate\Database\Eloquent\Model;

class DivisionLocale extends Model
{
    /**
     * The database table doesn't use 'created_at' and 'updated_at' so we disable it from Inserts/Updates.
     *
     * @var bool
     */
    public $timestamps = false;


    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
