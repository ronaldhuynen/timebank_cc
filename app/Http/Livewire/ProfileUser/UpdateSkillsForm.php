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
    public $suggestions = [];


    //! TODO: fix max characters validation!
     protected $rules = [
        'tags.*' => 'required|string|max:3',
    ];

    public function mount()
    {
        $tagService = app(TagService::class);
        $this->suggestions = (new Tag())->localTagArray(app()->getLocale());
        $tags = session('activeProfileType')::find(session('activeProfileId'))->tags()->get();
        $tags = collect(json_decode($tags))->pluck('normalized')->toArray();
        $this->tags = implode(", ", $tags);
    }

    public function updated()
    {
        $this->tags = collect(json_decode($this->tags))->pluck('value')->toArray();
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
            $this->validate();  // 2nd validation, just before save method
            $this->resetErrorBag();
           // $phone = new PhoneNumber($this->state['phone'], $this->phonecode);
            //$user->phone = $phone;
            //$user->phone_public_for_friends = $this->state['phone_public_for_friends'];

                        
            $owner->detag();
            $tagList = (implode(", ", $this->tags));
            $owner->tag($tagList);
            $this->tags = '';

        } else {
            $this->resetErrorBag();
            $owner->detag();
        }

        $this->emit('saved');
    }



    public function render()
    {
        return view('livewire.profile-user.update-skills-form');
    }
}
