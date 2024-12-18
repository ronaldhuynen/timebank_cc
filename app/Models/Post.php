<?php

namespace App\Models;

use App\Helpers\StringHelper;
use App\Models\Category;
use App\Models\Image;
use App\Models\Meeting;
use App\Models\PostTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Znck\Eloquent\Traits\BelongsToThrough;


class Post extends Model implements HasMedia
{
    use HasFactory;
    use BelongsToThrough;
    use InteractsWithMedia;
    use SoftDeletes;
    use Searchable; // laravel/scout with ElasticSearch



    protected $fillable = ['postable_id', 'postable_type',  'category_id'];

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'posts_index';
    }

    
    /**
     * Convert the this model to a searchable array.
     *
     * @return array
     */
    public function toSearchableArray()    
    {
        return [
            'id' => $this->id,

            'postable' => [
                'id' => $this->postable ? $this->postable->id : '',
                'name' => $this->postable ? $this->postable->name : '',
            ],

            'post_translations' => $this->translations->mapWithKeys(function ($translation) {
                // mapWithKeys() as translations is a collection
                return [
                    'title_' . $translation->locale => $translation->title,
                    'excerpt_' . $translation->locale => $translation->excerpt,
                    'content_' . $translation->locale => $translation->content,
                ];
            })->toArray(),

            'post_category' => $this->category ? [
                'id' => $this->category->id,
                'names' => $this->category->translations->mapWithKeys(function ($translation) {
                    // Include the locale in the field name for categories
                    return ['name_' . $translation->locale => StringHelper::DutchTitleCase($translation->name)];
                })->toArray(),
            ] : [],
        ];
    }



    /**
     * Get the creator of the post (i.e. user or organization).
     *
     * @return void
     */
    public function postable()
    {
        return $this->morphTo();
    }


    /**
     * Get the related translations of the post
     * One-to-many relationship
     * @return void
     */
    public function translations()
    {
        return $this->hasMany(PostTranslation::class);
    }


    /**
     * Get the related category of the post
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }



    /**
     * Get the related images of the posts
     *
     * @return void
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }


    public static function last()
    {
        return static::all()->last();
    }


    /**
     * Spatie Media Library media conversions
     * When updated you can use:
     * php artisan media-library:regenerate
     * to regenerate media disk and database of all media stored (make sure you restart the queue worker first)
     *
     * @param  mixed $media
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('favicon')    //1:1
            ->focalCrop(32, 32, 50, 50)
            ->optimize()
            ->format('gif'); // Ensure the format is set to gif to preserve transparency
            
        $this->addMediaConversion('logo')   //1:1
            ->focalCrop(160, 160, 50, 50)
            ->optimize()
            ->format('webp'); // Ensure the format is set to webp to preserve transparency

        $this->addMediaConversion('thumbnail')  // 1:1
            ->focalCrop(150, 150, 50, 50)
            ->optimize()
            ->format('webp'); // Ensure the format is set to webp to preserve transparency
        
        $this->addMediaConversion('blog')   //3:2
            ->focalCrop(1200, 630, 50, 50)
            ->withResponsiveImages()
            ->optimize()
            ->format('webp'); // Ensure the format is set to webp to preserve transparency

        $this->addMediaConversion('hero')   //16:9
            ->focalCrop(3840, 2160, 50, 50)
            ->withResponsiveImages()
            ->optimize()
            ->format('webp'); // Ensure the format is set to webp to preserve transparency
            
        $this->addMediaConversion('half_hero') //16:4.5 panoramic
            ->focalCrop(3840, 1080, 50, 50)
            ->format('webp'); // Ensure the format is set to webp to preserve transparency

        $this->addMediaConversion('4_3')    //4:3
            ->focalCrop(3072, 2304, 50, 50)
            ->withResponsiveImages()
            ->optimize()
            ->format('webp'); // Ensure the format is set to webp to preserve transparency
        
    }

    public function registerMediaCollection(): void
    {
        $this->addMediaCollection('posts')
            ->useDisk('media')
            ->singleFile();
    }


    /**
     * Get the related meeting of the post
     * One-to-one relation
     *
     * @return void
     */
    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }


}
