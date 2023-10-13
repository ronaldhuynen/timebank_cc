<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikeButton extends Component
{
    public $count = 0;
    public $likedByUser = false;
    public $model;

    public function mount($likecounter = null)
    { 
        if ($likecounter) {
            $this->model = $likecounter->likeable_type::find($likecounter->likeable_id);
            $this->count = $likecounter->count;
            
            $this->likedByUser = $this->model->liked();
         }      
    }


    public function like()
    {
        $this->model->like();
    }


    public function unlike()
    {
        if ($this->liked)
        {
            $this->model->unlike();
        }
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
