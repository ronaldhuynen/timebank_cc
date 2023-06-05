<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['imageable_id', 'imageable_type'];


    /**
     * Get the related posts of the images
     *
     * @return void
     */
    public function posts()
    {
    return $this->morphedByMany(Post:: class, 'imageable');
    }
}
