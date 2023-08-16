<?php

namespace App\Models;

use App\Traits\TaggableWithLocale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaggableContext extends Model
{
    use HasFactory;
    use TaggableWithLocale;

    //! TODO: This method is not tested yet, as there's no interface yet for updating taggable_contexts 
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

    protected $table = 'taggable_contexts';

    protected $guarded = [];


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'taggable_locale_context', 'context_id', 'tag_id');
    }
}
