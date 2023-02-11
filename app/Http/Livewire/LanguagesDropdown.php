<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LanguagesDropdown extends Component
{
    public $state = [];
    public $languages;
    public $langSelected;
    public $label;


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        $this->languages = collect(array_keys(config('timebank-cc.languages')));
        $this->label = __('What language(s) do you speak?');
    }



    public function render()
    {
        return view('livewire.languages-dropdown');
    }
}
