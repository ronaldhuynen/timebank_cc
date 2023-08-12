<?php

namespace App\Http\Livewire\ProfileUser;

use Livewire\Component;

class UpdateSkillsForm extends Component
{
    public $phoneCodeOptions;
    public $state;
    public $tags=[];
    public $suggestions = [];


    public function mount()
    {
        $this->fill([
            'tags' => implode(',', $this->tags),
            'suggestions' => $this->suggestions
            ]);
    }


    public function render()
    {
        return view('livewire.profile-user.update-skills-form');
    }
}
