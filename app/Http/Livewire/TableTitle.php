<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableTitle extends Component
{
    public $title;

    protected $listeners = ['tableTitle'=> 'tableTitleDispatched'];


    public function tableTitleDispatched($title)
    {
        $this->title = $title;
    }


    public function render()
    {
        return view('livewire.table-title');
    }
}
