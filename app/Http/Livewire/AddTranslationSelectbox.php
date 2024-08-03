<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddTranslationSelectbox extends Component
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
        $langOptions = DB::table('languages')
            ->whereIn('lang_code', $available)            
            ->orderBy('name')
            ->get(['id','lang_code','name']);
            
        $this->langOptions =  $langOptions->map(function ($item, $key) {
            return  [
                'id' => $item->id,
                'lang_code' => $item->lang_code,
                'name' => __('messages.' . $item->name)];
        });

        $this->localeSelected = $locale;
    }

    /**
     * When component is updated
     *
     * @return void
     */
    public function updated()
    {
        if ($this->localeSelected) {
            $this->dispatch('languageToParent', $this->localeSelected);
        }
    }


    public function render()
    {
        return view('livewire.add-translation-selectbox');
    }
}
