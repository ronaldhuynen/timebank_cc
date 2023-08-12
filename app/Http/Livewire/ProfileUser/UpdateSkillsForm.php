<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\Tag;
use Cviebrock\EloquentTaggable\Services\TagService;
use Livewire\Component;

class UpdateSkillsForm extends Component
{
    public $phoneCodeOptions;
    public $state;
    public $tags=[];
    public $suggestions = [];


    public function mount()
    {
        $tagService = app(TagService::class);        
        $this->suggestions = (new Tag())->localTagArray('en');
        $this->fill([
            'tags' => implode(',', $this->tags),
            // 'suggestions' => $this->suggestions
            ]);
    }


    public function render()
    {
        return view('livewire.profile-user.update-skills-form');
    }
}
