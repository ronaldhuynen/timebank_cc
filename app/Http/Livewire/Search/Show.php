<?php

namespace App\Http\Livewire\Search;

use Livewire\Component;

class Show extends Component
{
   public $results;



    public function render()
    {
        info($this->results);
        return view('livewire.search.show', ['results' => $this->results]);
    }
}
