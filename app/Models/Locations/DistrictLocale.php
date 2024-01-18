<?php

namespace App\Models\Locations;

use App\Models\Scopes\LocalizeScope;
use Illuminate\Database\Eloquent\Model;

class DistrictLocale extends Model
{
    /**
     * The database table doesn't use 'created_at' and 'updated_at' so we disable it from Inserts/Updates.
     *
     * @var bool
     */
    public $timestamps = false;

    
    protected static function booted()
    {
        // Scope a query to only include country locales that match the current application locale or fallback locale.
        static::addGlobalScope(new LocalizeScope);
    }


    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
