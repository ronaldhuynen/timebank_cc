<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LanguagesDropdown extends Component
{
    public $state = [];
    public $langOptions = [];
    public $langSelected = [];
    public $langSelectedOptions = [];


    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount()
    {
        // Joeri: het probleem was domweg dat we niet User::find(2)->languages(), maar User::find(2)->languages als methode moesten formuleren...
        $this->state = Auth::user()->withoutRelations()->toArray();

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

        // Create an array of the (pre)selected language options
        $this->langSelected = User::find($this->state['id'])->languages;
        $this->langSelected = $this->langSelected->map(function ($language, $key) {
            $competence = DB::table('language_competences')->find($language->pivot->competence);
            $langSelected = collect($this->langOptions)->where('name', trans($language->name) . ' - ' . trans($competence->name));
            return [
                $langSelected->keys()
            ];
        });
        $this->langSelected = $this->langSelected->flatten();

        // Create a selected language collection that holds the selected languages with their selected competences
        $this->langSelectedOptions = collect($this->langOptions)->whereIn('id', $this->langSelected);
    }

    /**
     * When component is updated, create a selected language collection that holds the selected languages with their selected competences
     *
     * @return void
     */
    public function updated()
    {
        $this->langSelectedOptions = collect($this->langOptions)->whereIn('id', $this->langSelected);
        $this->emit('languagesToParent', $this->langSelectedOptions);
    }


    public function render()
    {
        return view('livewire.languages-dropdown');
    }
}
