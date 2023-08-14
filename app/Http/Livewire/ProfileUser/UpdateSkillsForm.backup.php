<?php

namespace App\Http\Livewire\ProfileUser;

use App\Models\Tag;
use App\Traits\TaggableWithLocale;
use Cviebrock\EloquentTaggable\Services\TagService;
use Livewire\Component;

class UpdateSkillsForm extends Component
{
    use TaggableWithLocale;

    public $tags = '';
    public $tagsArray = [];
    public $suggestions = [];


    //! TODO: fix max characters validation!
     protected $rules = [
        'tagsArray.*' => 'required|string|max:50',   // make sure to set also 50 in Alpine Tagify script (in view)
    ];

    public function mount()
    {
        $tagService = app(TagService::class);
        $this->suggestions = (new Tag())->localTagArray(app()->getLocale());
        $tags = session('activeProfileType')::find(session('activeProfileId'))->tags()->get();
        $tags = collect(json_decode($tags))->pluck('normalized')->toArray();
        $this->tagsArray = $tags;
        $this->tags = implode(", ", $tags);
    }

    public function updated()
    {
        $this->tagsArray = collect(json_decode($this->tags))->pluck('value')->toArray();
        }



    /**
     * Update the user's skill tags information.
     *
     * @return void
     */
    public function saveTags()
    {
        $owner = session('activeProfileType')::find(session('activeProfileId'));

        if ($this->tags != null) {
            // dd($this->tagsArray);
            $this->validate();  // 2nd validation, just before save method
            $this->resetErrorBag();                       
            $owner->detag();
            $tagList = (implode(", ", $this->tagsArray));
            $owner->tag($tagList);
            $this->tags = '';
            $this->tagsArray = [];

        } else {
            $this->resetErrorBag();
            $owner->detag();
            $this->tags = '';
            $this->tagsArray = [];

        }

        $this->emit('saved');
    }



    public function render()
    {
        return view('livewire.skills-form');
    }
}
