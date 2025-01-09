<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaggableLocaleContext extends Model
{
    use HasFactory;

    protected $table = 'taggable_locale_context';


    protected $guarded = [];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'taggable_locale_context', 'context_id', 'tag_id');
    }

}
