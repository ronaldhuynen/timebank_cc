<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path','position','caption'];


    /**
     * Get the related posts of the images
     *
     * @return void
     */
    public function posts(): MorphToMany
    {
    return $this->morphedByMany(Post:: class, 'imageable');
    }
}
