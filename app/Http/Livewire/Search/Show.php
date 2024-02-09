<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;

class Show extends Component
{
   public $results;



    public function render()
    {
        return view('livewire.search.show', ['results' => $this->results]);
    }
}
