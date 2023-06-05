<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    /**
     * Get the related posts for this category
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
