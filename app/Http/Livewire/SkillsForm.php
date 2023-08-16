<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use App\Models\TaggableLocale;
use App\Traits\TaggableWithLocale;
use Cviebrock\EloquentTaggable\Services\TagService;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class SkillsForm extends Component
{
    use TaggableWithLocale;

    public $tags = '';
    public $tagsArray = [];
    public $initTagsArray = [];
    public $newTagsArray;
    public $suggestions = [];

    protected $listeners = ['save'];

    protected $rules = [
        'newTagsArray' => 'array',
        'newTagsArray.*.value' => 'required|string|max:10',   // make sure to set also 50 in Alpine Tagify script (in view)
        'newTagsArray.*.example' => 'string|max:200', 
        'newTagsArray.*.locale' => 'string|max:6', 

    ];

    public function mount()
    {
        $tagService = app(TagService::class);

        $this->suggestions = (new Tag())->localTagArray(app()->getLocale());

        $sourceIds = session('activeProfileType')::find(session('activeProfileId'))->tags()->get()->pluck('tag_id');
        // $sourceIds = collect(json_decode($sourceTags))->pluck('tag_id')->toArray();

        // dump($sourceIds);

        $translatedIds = collect( (new Tag())->translateTagIds($sourceIds, App::getLocale(), App::getFallbackLocale()) );     // Translate to app locale, if not available to fallback locale, if not available do not translate
        // dump($translatedIds);
        $translatedTags = Tag::find($translatedIds);
        // dd($translatedTags);
   

        // $tags = collect(json_decode($translatedTags))->pluck('normalized')->toArray();
        // $tags = collect(json_decode($translatedTags));
        $tags = $translatedTags->map(function ($item, $key) {

            $locale = TaggableLocale::where('taggable_tag_id', $item->tag_id)->get();

            return [
               'value' => $item->normalized,
               'readonly' => ( $locale->first()->locale ==  App::getLocale() ) ? false : true,
               'title' =>  $locale->pluck('example')->first(),
               'locale' => $locale->pluck('locale')->first(),
               ];
        });

        $this->initTagsArray = $tags->toArray();
        $this->tagsArray = json_encode($this->initTagsArray);
        // dd($this->tagsArray);
        // $this->tags = $tags->toArray();
        // dd($this->tags);
        // $this->tags = implode(", ", $tags);
    }

    public function updating()  // Note this is not updated(), as tagify catches the json too soon?
    {
        $this->tagsArray = json_encode(json_decode($this->tagsArray));    // re-encode the json
        // dump($this->tagsArray);

        
        // $diff = $this->initTagsArray->diff($this->tagsArray);

        // dd($diff);
        // $this->tags = $this->tagsArray;
        // dump($t);
    }

    public function updated()
    {
        $this->initTagsArray = collect($this->initTagsArray);
        
        $this->newTagsArray = collect(json_decode($this->tagsArray, true));
        
        // dump($this->newTagsArray->where('readonly','<>', true));


    }


    /**
     * Update the user's skill tags information.
     *
     * @return void
     */
    public function save()
    {
        
        // dump($this->initTagsArray);


        $owner = session('activeProfileType')::find(session('activeProfileId'));

        // if ($this->tags != null) {
            // dd($this->tagsArray);
            $this->validate();  // 2nd validation, just before save method
            $this->resetErrorBag();
            
// dd("save?");
            $untag = $this->initTagsArray->where('readonly', '<>', true)->pluck('value')->toArray();
            $untag = (implode(", ", $untag));
            // dd($untag);
            $owner->untag($untag);

            $tag = $this->newTagsArray->where('readonly', '<>', true)->pluck('value')->toArray();
            $tag = (implode(", ", $tag));
            $owner->tag($tag);
            
            // $this->tagsArray = [];

        // } else {
        //     $this->resetErrorBag();
        //     $owner->detag();
        //     $this->tags = '';
        //     $this->tagsArray = [];

        // }

        $this->emit('saved');
    }



    public function render()
    {
        return view('livewire.skills-form');
    }
}
