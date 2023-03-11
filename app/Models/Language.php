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
     * Get all organisations that are assigned to this language.
     */
    public function organisations()
    {
        return $this->morphedByMany(Organisation::class, 'languagable');
    }

}
