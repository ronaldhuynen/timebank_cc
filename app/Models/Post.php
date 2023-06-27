<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Image;
use App\Models\PostTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use Znck\Eloquent\Traits\BelongsToThrough;

class Post extends Model implements HasMedia
{
    use HasFactory, BelongsToThrough, InteractsWithMedia;


    protected $fillable = ['postable_id', 'postable_type',  'category_id'];

    /**
     * Get the creator of the post (i.e. user or organisation).
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
     * Get the related catogory of the post
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
        $this->addMediaConversion('x-small')
            ->focalCrop(36, 36, 50, 50);

        $this->addMediaConversion('thumbnail')
            ->focalCrop(150, 150, 50, 50);

        $this->addMediaConversion('4_3')
            ->focalCrop(3072, 2304, 50, 50)
            ->withResponsiveImages();
    }

    public function registerMediaCollection(): void
    {
        $this->addMediaCollection('posts')
            ->singleFile();
    }

}