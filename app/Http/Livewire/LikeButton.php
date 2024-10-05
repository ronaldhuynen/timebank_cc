<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikeButton extends Component
{
    public $model;
    public $count = 0;
    public $activeProfile;
    public $likedByReacter = false;
    public $typeName;

    public function mount($model, $likedCounter = null)
    { 
        $this->model = $model;
        $likedCounter ? $this->count = $likedCounter : $this->count = 0 ;
        // check if the active profile has liked the model using the laravel-love facade viaLoveReacter()
        $this->activeProfile = getActiveProfile();
        $this->likedByReacter = $this->activeProfile->viaLoveReacter()->hasReactedTo($this->model);
}

    public function like()
    {
        // If active profile is not the model, the profile can like the model
        if (session('activeProfileType') === $this->model::class && session('activeProfileId')  !== $this->model->id || session('activeProfileType') !== $this->model::class) {
            $this->count++;
            $this->likedByReacter = true;
            $this->activeProfile->viaLoveReacter()->reactTo($this->model, $this->typeName);
        } 
    }


    public function unlike()
    {
            $this->count--;
            $this->likedByReacter = false;
            $this->activeProfile->viaLoveReacter()->unReactTo($this->model, $this->typeName);
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
