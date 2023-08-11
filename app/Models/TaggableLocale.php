<?php

namespace App\Models;

use App\Models\Tag;
use App\Traits\TaggableWithLocale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaggableLocale extends Model
{
    use HasFactory;
    use TaggableWithLocale;


    protected $guarded = [];




    public function tag()
    {
        return $this->belongsTo(Tag::class, 'taggable_tag_id', 'tag_id');
    }



}
