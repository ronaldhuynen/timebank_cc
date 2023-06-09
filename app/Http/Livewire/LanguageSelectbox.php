<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LanguageSelectbox extends Component
{
    public $langOptions = [];
    public $langSelected;


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->langOptions = DB::table('languages')->get(['id','lang_code','name']);
    }

    /**
     * When component is updated
     *
     * @return void
     */
    public function updated()
    {
        $this->emit('languageToParent', $this->langSelected);
    }


    public function render()
    {
        return view('livewire.language-selectbox');
    }
}
