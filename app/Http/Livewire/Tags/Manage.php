<?php

namespace App\Http\Livewire\Tags;

use App\Models\Tag;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Manage extends Component
{
    
    use WithPagination;

    
    public string $search;
    public bool $showModal = false;
    public $createTranslation;
    public int $tagId;
    public $bulkSelected = [];
    public bool $bulkDisabled = true;
    public int $categoryId;
    public int $tag;

    public bool $modalDeleteTag = false;
    public $selectedDeleteTag;
    public int $selectedDeleteTagId;    // Needed for the modalDeleteTag
    public int $countTotal;

    public $localeInit;
    public $locale;
    public $localesOptions = [];
    public $language;

    public $perPage = 10;


    public function openDeleteTagModal($tagId)
    {
        $countUsers = Tag::find($tagId)->users->count();
        $countOrgs = Tag::find($tagId)->organizations->count();
        $countBanks = Tag::find($tagId)->Banks->count();
        $this->countTotal = $countUsers + $countOrgs + $countBanks;
        $this->selectedDeleteTag = Tag::find($tagId);
        $this->selectedDeleteTagId = $tagId;
        $this->modalDeleteTag = true;
    }


    /**
     * Delete the tag
     *
     * @param  mixed $translationId
     * @return void
     */
    public function deleteTag($tagId)
    {
        $tag = Tag::find($tagId);
        if ($tag) {
            $tag->delete(); // The Tag model has a listener that also deletes associates models
            $this->resetForm();
            $this->resetPage();
        }
        $this->modalDeleteTag = false;
    }


    public function resetForm()
    {
        $this->reset(['selectedDeleteTagId', 'selectedDeleteTag', 'modalDeleteTag', 'countTotal']);
        $this->modalDeleteTag = false;
        $this->countTotal = 0;
    }


    public function render()
    {
        $locale = App::getLocale();
        $baseLocale = config('base_language');

    
        $tags = Tag::orderBy('updated_at', 'desc')
            ->paginate($this->perPage);


        return view('livewire.tags.manage', [
            'tags' => $tags
        ]);
    }
}
