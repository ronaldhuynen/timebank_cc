<?php

namespace App\Models;

use App\Models\TagContext;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends \Cviebrock\EloquentTaggable\Models\Tag
{
    use HasFactory;

    protected $table = 'taggable_tags';

    protected $primaryKey = 'tag_id';

    public function contexts() 
    {
        return $this->hasMany(TagContext::class, 'taggable_tag_id');
    }
}
