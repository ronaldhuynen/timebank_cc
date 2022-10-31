<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserDatatables extends LivewireDatatable

{
    public $model = User::class;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function columns()
    {
        return [
            NumberColumn::name('id')->label('id')->sortBy('id'),
            Column::name('name')->label('name'),
            Column::name('email'),
            Column::name('email_verified_at')->label('verified at'),
            Column::name('locale'),
            Column::name('profile_photo_path')->excludeFromExport()->label('profile'),
            DateColumn::name('created_at')->label('created'),
            DateColumn::name('deleted_at')->label('deleted'),
        ];
    }
}
