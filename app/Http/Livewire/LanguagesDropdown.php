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
    // public $languages = [];
    public $langOptions = [];
    public $langSelected = [];
    public $label;


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
                'name' => $language[0]->name . ' - ' . $language[1]->name,
            ];
        });

        // dump($this->langOptions);

        // Create an array of the (pre)selected language options
        $this->langSelected = User::find($this->state['id'])->languages;
        $this->langSelected = $this->langSelected->map(function ($language, $key) {
            $competence = DB::table('language_competences')->find($language->pivot->competence);
            $langSelected = collect($this->langOptions)->where('name', $language->name . ' - ' . $competence->name);
            // dump($langSelected->keys());
            return [
                $langSelected->keys()
            ];
        });
        $this->langSelected = $this->langSelected->flatten();
        // dump($this->langSelected);
    }

    public function updated()
    {
        $this->emit('languagesToParent', $this->langSelected);
    }


    public function render()
    {
        return view('livewire.languages-dropdown');
    }
}
