<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AddTranslationSelectbox extends Component
{
    public $options = [];
    public $localeSelected;

    protected $listeners = ['updateLocalesOptions'];
    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount($locale = null, $options)
    {        
        $this->updateLocalesOptions($options);
        
        $locale = $locale ?? session('locale');
        
        // Extract lang_code values from the options collection
        $availableLocales = $this->options ? $this->options->pluck('lang_code')->all() : [];

        if (!in_array($locale, $availableLocales)) {
            $locale = null;
        }

        $this->localeSelected = $locale;
    }
    

    public function updateLocalesOptions($options)
    {   
        if ($options) {
            $options = DB::table('languages')
                ->whereIn('lang_code', $options)
                ->orderBy('name')
                ->get(['id','lang_code','name']);

            $this->options =  $options->map(function ($item, $key) {
                return  [
                    'id' => $item->id,
                    'lang_code' => $item->lang_code,
                    'name' => __('messages.' . $item->name)];
            });
        }
    }

    
    /**
     * When component is updated
     *
     * @return void
     */
    public function updated()
    {
        if ($this->localeSelected) {
            $this->dispatch('localeSelected', $this->localeSelected);
        }
    }


    public function render()
    {
        return view('livewire.add-translation-selectbox');
    }
}
