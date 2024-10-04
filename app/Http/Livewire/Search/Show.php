<?php

namespace App\Http\Livewire\Search;

use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Show extends Component
{
   public $results;

   public function showProfile($id, $model)
   {    
    $modelName = strtolower($model);
    $modelName = $modelName === 'organization' ? 'org' : $modelName;
    return Redirect::route("{$modelName}.show", ['id' => $id]);

   }


    public function render()
    {
        return view('livewire.search.show', ['results' => $this->results]);
    }
}
