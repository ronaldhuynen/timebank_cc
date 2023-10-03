<?php

namespace App\Http\Livewire\ProfileUser;

use Livewire\Component;

class Show extends Component
{
    public $user;
    
    public function mount()
    {
        ds($this->user);
    }
    
    public function render()
    {
        return view('livewire.profile-user.show');
    } 
}
