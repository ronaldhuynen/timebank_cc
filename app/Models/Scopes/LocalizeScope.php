<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\App;

class LocalizeScope implements Scope
{
    /**
        * Apply the scope to a given Eloquent query builder.
        * Gets the localized name of a model.
        * In the App::getLocale, or if not exists, in the App::getFallbackLocale language.
        *
        * @param  \Illuminate\Database\Eloquent\Builder  $builder The Eloquent query builder.
        * @param  \Illuminate\Database\Eloquent\Model  $model The Eloquent model.
        * @return void
        */
        public function apply(Builder $builder, Model $model)
        {
            $builder->where('locale', App::getLocale())
                ->orWhere('locale', App::getFallbackLocale())
                ->orderByRaw("(CASE WHEN locale = ? THEN 1 WHEN locale = ? THEN 2 END)", [App::getLocale(), App::getFallbackLocale()]);
        }
}
