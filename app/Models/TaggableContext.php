<?php

namespace App\Models;

use App\Traits\TaggableWithLocale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaggableContext extends Model
{
    use HasFactory;
    use TaggableWithLocale;



    protected $table = 'taggable_contexts';

    protected $guarded = [];


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'taggable_locale_context', 'context_id', 'tag_id');
    }
}
