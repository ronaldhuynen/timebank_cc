<?php

namespace App\Models;

use App\Models\CategoryTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

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
     * Get the polymorph relation of this type of category (i.e. division, user, organization).
     *
     * @return void
     */
    public function categoryable()
    {
        return $this->morphTo();
    }

}
