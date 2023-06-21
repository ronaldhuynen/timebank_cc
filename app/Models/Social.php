<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'url_structure'
    ];

    protected $guarded = [];


    /**
     * Get all sociables that are assigned to this social.
     */
    public function sociables()
    {
        return $this->morphedByMany(User::class, 'sociable');
    }


    /**
     * Get all users that are assigned to this social.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'sociable')->where('sociable_type', User::class);
    }


    /**
     * Get all organisations that are assigned to this social.
     */
    public function organisations()
    {
        return $this->morphedByMany(Organisation::class, 'sociable')->where('sociable_type', Organisation::class);
        ;
    }

}
