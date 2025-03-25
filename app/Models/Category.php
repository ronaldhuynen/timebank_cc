<?php

namespace App\Models;

use App\Models\CategoryTranslation;
use App\Models\TaggableContext;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    protected $appends = ['translation', 'relatedPathTranslation', 'relatedPathExSelfTranslation', 'relatedColor'];
    protected $fillable = ['type', 'country_id', 'division_id', 'city_id', 'district_id'];


    /**
     * Get the related posts for this category
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the related translations of this category
     *
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
    


    /**
     * Get the translation attribute for the category.
     *
     * This method attempts to retrieve the translation for the category
     * in the current locale. If a translation in the current locale is
     * not found, it falls back to the base locale defined in the timebank-cc config.
     *
     * @return \App\Models\Translation|null The translation object for the category in the current or base locale, or null if not found.
     */
    public function getTranslationAttribute()
    {
        $locale = App::getLocale();
        $baseLocale = config('timebank-cc.base_language');

        // Attempt to get the translation in the current locale
        $translation = $this->translations->firstWhere('locale', $locale);

        // Fallback to base locale if translation not found
        if (!$translation) {
            $translation = $this->translations->firstWhere('locale', $baseLocale);
        }

        return $translation;
    }


    public function related()
    {   
        return $this->ancestorsAndSelf()->get();
    }


    public function getRelatedPathTranslationAttribute()
    {
        $categoryPathIds = $this->ancestors->pluck('id');
        $categoryPath = implode(
            ' > ',
            CategoryTranslation::whereIn('category_id', $categoryPathIds)
                            ->where('locale', App::getLocale())
                            ->pluck('name')
                            ->toArray()
        );

        return $categoryPath;
    }

    
    public function getRelatedPathExSelfTranslationAttribute()
    {
        $categoryPathIds = $this->ancestors->pluck('id');
        $categoryPath = implode(
            ' > ',
            CategoryTranslation::whereIn('category_id', $categoryPathIds)
                            ->where('locale', App::getLocale())
                            ->pluck('name')
                            ->toArray()
        );

        return $categoryPath;
    }


    public function getRelatedColorAttribute()
    {
        $categoryColor = $this->rootAncestor ? $this->rootAncestor->color : $this->color;

        return $categoryColor;
    }

    /**
     * Get the polymorph relation of this type of category (i.e. division, user, organization).
     *
     * @return void
     */
    public function categoryable()
    {
        return $this->morphTo();
    }

    
    public function tagContext()
    {
        return $this->hasOne(TaggableContext::class);
    }

}
