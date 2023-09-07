<?php

namespace App\Models;

use App\Models\TaggableContext;
use App\Models\TaggableLocale;
use App\Traits\TaggableWithLocale;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends \Cviebrock\EloquentTaggable\Models\Tag

    /**
     * Class Tag extends \Cviebrock\EloquentTaggable\Models\Tag
     *
     * This extended the Tag class of cvierock / eloquent-taggable package.
     * It adds an one-to-many relationship to store additional tag context data in the tag_contexts table.
     * Use this extension with the trait App\Traits\TaggableWithContext.
     *
     */
{
    use HasFactory;
    use TaggableWithLocale;



    protected $table = 'taggable_tags';

    protected $primaryKey = 'tag_id';



    public function locale()
    {
        return $this->hasOne(TaggableLocale::class, 'taggable_tag_id');
    }



    public function localeCode()
    {
        return $this->hasOne(TaggableLocale::class, 'taggable_tag_id')->select('locale');
    }


    public function contexts()
    {
        return $this->belongsToMany(TaggableContext::class, 'taggable_locale_context', 'tag_id', 'context_id');
    }


    /**
     * Scope to find tags by name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByLocalName(Builder $query, string $value): Builder
    {
        $normalized = app(TagService::class)->normalize($value);

        return $query->where('normalized', $normalized);
    }


}
