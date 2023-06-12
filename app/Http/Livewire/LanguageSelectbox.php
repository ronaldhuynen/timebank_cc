<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LanguageSelectbox extends Component
{
    public $langOptions = [];
    public $localeSelected;


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount($locale, $exclude)
    {
        info($exclude);
        $this->langOptions = DB::table('languages')->whereNotIn('lang_code', $exclude)->get(['id','lang_code','name']);
        $this->localeSelected = $locale;
    }


    /**
     * When component is updated
     *
     * @return void
     */
    public function updated()
    {
        $this->emit('languageToParent', $this->localeSelected);
    }


    public function render()
    {
        return view('livewire.language-selectbox');
    }
}
