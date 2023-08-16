<?php

namespace App\Models;

use App\Models\Tag;
use App\Traits\TaggableWithLocale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaggableLocale extends Model
{
    use HasFactory;
    use TaggableWithLocale;

    protected static function boot()
    {
        parent::boot();

        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('updated_by_user_id')) {
                $model->updated_by_user_id = auth()->user()->id;
            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by_user_id')) {
                $model->updated_by_user_id = auth()->user()->id;
            }
        });
    }


    protected $guarded = [];

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'taggable_tag_id', 'tag_id');
    }



}
