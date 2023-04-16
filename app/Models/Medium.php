<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'url_structure'
    ];

    protected $guarded = [];


    /**
     * Get all mediables that are assigned to this medium.
     */
    public function mediables()
    {
        return $this->morphedByMany(User::class, 'mediable');
    }


    /**
     * Get all users that are assigned to this medium.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'mediable')->where('mediable_type', User::class);
    }


    /**
     * Get all organisations that are assigned to this medium.
     */
    public function organisations()
    {
        return $this->morphedByMany(Organisation::class, 'mediable')->where('mediable_type', Organisation::class);
        ;
    }

}
