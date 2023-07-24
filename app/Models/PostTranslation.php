<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostTranslation extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = ['post_id', 'locale', 'slug', 'title', 'excerpt', 'content', 'status', 'start', 'stop'];


    /**
     * Get related post for this translation
     * Ont-to-many relationship
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
