<?php

namespace App\Http\Livewire\ProfileOrg;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LanguagesDropdown extends Component
{
    public $state = [];
    public $langSelected = [];
    public $langSelectedOptions = [];
    public $langOptions;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount($languages)
    {
        // Create a language options collection that combines all language and competence options
        $langOptions = DB::table('languages')->get(['id','name']);
        $compOptions = DB::table('language_competences')->get(['id','name']);
        $langOptions = collect(Arr::crossJoin($langOptions, $compOptions));
        $this->langOptions = $langOptions->Map(function ($language, $key) {
            return [
                'id' => $key,   // index key is needed to select values in dropdown (option-value)
                'langId' => $language[0]->id,
                'compId' => $language[1]->id,
                'name' => trans($language[0]->name) . ' - ' . trans($language[1]->name),
            ];
        });

        $this->langSelectedOptions = $languages;
        $this->langSelected = $this->langSelectedOptions->pluck('id');
    }

    
    /**
     * When component is updated, create a selected language collection that holds the selected languages with their selected competences
     *
     * @return void
     */
    public function updated()
    {
        $this->langSelectedOptions = collect($this->langOptions)->whereIn('id', $this->langSelected);
        $this->dispatch('languagesToParent', $this->langSelectedOptions);
    }


    public function render()
    {
        return view('livewire.profile-org.languages-dropdown');
    }
}
