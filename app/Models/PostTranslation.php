<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'locale', 'slug', 'title', 'excerpt', 'content', 'start', 'stop'];


    /**
     * Get related post for this translation
     * Ont-to-many relationship
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
