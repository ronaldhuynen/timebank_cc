<?php

namespace App\Http\Livewire\ProfileUser;

use Livewire\Component;

class UpdateSkillsForm extends Component
{
    public $phoneCodeOptions;

    public function render()
    {
        return view('livewire.profile-user.update-skills-form');
    }
}
