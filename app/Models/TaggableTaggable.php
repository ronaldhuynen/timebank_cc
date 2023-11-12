<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TaggableTaggable extends Model
{
    use HasFactory;

    public static function boot() 
    {
        Static::updating(function() {
            // Cache::forget('skills-user' . $this->user->id . '-lang' . app()->getLocale());
        });
    }

    protected $table = 'taggable_taggables';

    protected $guarded = [];
}
