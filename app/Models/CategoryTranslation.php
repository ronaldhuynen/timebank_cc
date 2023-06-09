<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'locale', 'slug', 'name'];


    /**
     * Get related category for this translation
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
