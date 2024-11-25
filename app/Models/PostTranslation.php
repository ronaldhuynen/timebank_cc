<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostTranslation extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = ['post_id', 'locale', 'slug', 'title', 'excerpt', 'content', 'status', 'updated_by_user_id', 'start', 'stop'];


    /**
     * Get related post for this translation
     * Ont-to-many relationship
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    /**
     * Get the user who last updated the post translation.
     */
    public function updated_by_user()
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
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
