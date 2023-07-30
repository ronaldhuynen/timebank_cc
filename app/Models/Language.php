<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

protected $fillable = [
        'name',
        'lang_code',
        'flag'
    ];

    /**
     * Get all users that are assigned to this language.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'languagable');
    }


    /**
     * Get all organizations that are assigned to this language.
     */
    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'languagable');
    }


    /**
     * Get all posts that are assigned to this language.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'languagable');
    }

}
