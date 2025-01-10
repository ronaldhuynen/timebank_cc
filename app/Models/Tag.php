<?php

namespace App\Models;

use App\Models\TaggableContext;
use App\Models\TaggableLocale;
use App\Traits\TaggableWithLocale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class Tag extends \Cviebrock\EloquentTaggable\Models\Tag

    /**
     * Class Tag extends \Cviebrock\EloquentTaggable\Models\Tag
     *
     * This extended the Tag class of cviebrock / eloquent-taggable package.
     * It adds an one-to-many relationship to store additional tag context data in the tag_contexts table.
     * Use this extension with the trait App\Traits\TaggableWithContext.
     *
     */
{
    use HasFactory;
    use TaggableWithLocale;
    use Searchable; // laravel/scout with ElasticSearch

    protected $table = 'taggable_tags';
    protected $primaryKey = 'tag_id';

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($tag) {
            // Remove relationships of users, organizations, banks
            $tag->users()->detach();
            $tag->organizations()->detach();
            $tag->banks()->detach();
            // Delete locales and contexts tied directly to the tag
            $tag->locale()->delete();
            $tag->contexts()->delete();
        });
    }
    // TODO NEXT: Check delete with translations and email with translation!

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'tags_index';
    }


    /**
     * Get the value used to index the model.
     */
    public function getScoutKey(): mixed
    {
        return $this->tag_id;
    }

    /**
     * Get the key name used to index the model.
     */
    public function getScoutKeyName(): mixed
    {
        return 'tag_id';
    }


    public function users() 
    {
        return $this->morphedByMany(User::class, 'taggable', 'taggable_taggables', 'tag_id', 'taggable_id');
    }

    
    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'taggable', 'taggable_taggables', 'tag_id', 'taggable_id');
    }


    public function banks()
    {
        return $this->morphedByMany(Bank::class, 'taggable', 'taggable_taggables', 'tag_id', 'taggable_id');
    }


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


    public function localeContext()
    {
        return $this->hasOne(TaggableLocaleContext::class, 'tag_id');
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



    /**
     * Get all related tags with their locales using a raw query.
     *
     * @return \Illuminate\Support\Collection
     */
    public function translations()
    {
        return DB::table('taggable_tags as tt')
            ->join('taggable_locale_context as tlc', 'tt.tag_id', '=', 'tlc.tag_id')
            ->join('taggable_locales as tl', 'tt.tag_id', '=', 'tl.taggable_tag_id')
            ->select('tt.*', 'tl.*', 'tlc.context_id')
            ->whereIn('tlc.context_id', function($query) {
                $query->select('context_id')
                    ->from('taggable_locale_context')
                    ->where('tag_id', $this->tag_id);
            })
            ->get();
    }

    /**
     * Get the translation attribute for the tag.
     *
     * This method attempts to retrieve the translation for the tag
     * in the current locale. If a translation in the current locale is
     * not found, it falls back to the base locale defined in the timebank-cc config.
     *
     * @return \App\Models\Translation|null The translation object for the category in the current or base locale, or null if not found.
     */
    public function getTranslationAttribute()
    {
        $baseLocale = config('timebank-cc.base_language');
        // Retrieve all translations using the translations() method
        $translations = $this->translations();

        // Attempt to get the translation in the current locale
        $translation = $translations->firstWhere('locale', App::getLocale());

        // Fallback to base locale if translation not found
        if (!$translation) {
            $translation = $translations->firstWhere('locale', $baseLocale);    
            // Fallback to only available locale if no translation in base locale is not found
            if (!$translation) {
                return $translations->first(); //We can do first() as tags can only be translated to the base locale. So there are no other translations.
            }
        }
        return $translation;
    }

//TODO NEXT: Fix how the SkillTagForms show and save the tags with the new translation() method.


}
