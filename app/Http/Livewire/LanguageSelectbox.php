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
    public function mount($locale, $available)
    {
        info($available);
        $this->langOptions = DB::table('languages')
            ->whereIn('lang_code', $available)            
            ->orderBy('name')
            ->get(['id','lang_code','name']);
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
