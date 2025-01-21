<?php

namespace App\Http\Livewire\Tags;

use App\Models\Category;
use App\Models\Tag;
use App\Models\TaggableContext;
use App\Models\TaggableLocaleContext;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Manage extends Component
{
    use WithPagination;


    public string $search = '';
    public bool $showModal = false;
    public $createTranslation;
    public int $tagId;
    public $bulkSelected = [];
    public bool $bulkDisabled = true;
    public int $categoryId;
    public int $tag;

    public bool $modalDeleteTag = false;
    public bool $modalEditTag = false;
    public $selectedTag;
    public int $selectedTagId;    // Needed for the modalDeleteTag
    public int $countTotal;
    public int $countTotalContext;

    public $localeInit;
    public $locale;
    public $localesOptions = [];
    public $language;

    public $initTag = [];
    public $editTag = [];
    public bool $editTagChanged = false;
    public bool $editTagContextChanged = false;
    public $categoryOptions = [];

    public $perPage = 5;


    public function openDeleteTagModal($tagId)
    {
        $countUsers = Tag::find($tagId)->users->count();
        $countOrgs = Tag::find($tagId)->organizations->count();
        $countBanks = Tag::find($tagId)->Banks->count();
        $this->countTotal = $countUsers + $countOrgs + $countBanks;
        $this->selectedTag = Tag::find($tagId);
        $this->selectedTagId = $tagId;
        $this->modalDeleteTag = true;
    }


    public function openEditTagModal($tagId)
    {
        // Count profiles who are associated with this tag
        $tag = Tag::withCount(['users', 'organizations', 'banks'])->find($tagId);
        $this->countTotal = $tag->users_count + $tag->organizations_count + $tag->banks_count;

        // Count profiles who are associated with the context of this tag, so also who have a translation of this tag associated
        $contextId = TaggableLocaleContext::where('tag_id', $tagId)->value('context_id');
        $tagsInContext = TaggableLocaleContext::where('context_id', $contextId)->pluck('tag_id')->values();
        $tags = Tag::whereIn('tag_id', $tagsInContext)
            ->withCount(['users', 'organizations', 'banks'])
            ->get();
        $countTagsInContextUsers = $tags->sum('users_count');
        $countTagsInContextOrgs = $tags->sum('organizations_count');
        $countTagsInContextBanks = $tags->sum('banks_count');
        $this->countTotalContext = $countTagsInContextUsers + $countTagsInContextOrgs + $countTagsInContextBanks;

        $this->selectedTag = $tag;
        $this->selectedTagId = $tagId;

        $categoryPath = (new \App\Models\Tag())->translateTagIdWithContext($this->selectedTag->tag_id)['category_id'] ?? '';
        $this->categoryOptions = Category::with([
                'translations' => function ($query) {
                    $query->where('locale', app()->getLocale())->select('id', 'category_id', 'name');
                },
            ])
                ->whereHas('translations', function ($query) {
                    $query->where('locale', app()->getLocale());
                })
                ->where('type', Tag::class)
                ->get()
                ->flatMap(function ($category) {
                    return $category->translations;
                })
                ->mapWithKeys(function ($translation) {
                    return [$translation->category_id => $translation->name];
                })
                ->map(function ($name, $index) {
                    return [
                        'category_id' => $index,
                        'name' => ucfirst($name),
                    ];
                })
                ->sortBy('name')
                ->values();


        $lang = DB::table('languages')
                        ->where('lang_code', $this->selectedTag->locale->locale)
                        ->value('name');

        $this->initTag = [
            'name' => $this->selectedTag->name,
            'example' => $this->selectedTag->locale->example,
            'category' => $categoryPath];
        $this->editTag = $this->initTag;

        $this->modalEditTag = true;
    }


    public function updatedEditTag($prop, $value)
    {
        // Check if editTag properties have changed
        if ($value === 'name') {
            if ($prop !== $this->initTag['name']) {
                $this->editTagChanged = true;
            }
        }
        if ($value === 'example') {
            if ($prop !== $this->initTag['example']) {
                $this->editTagChanged = true;
            }
        }
        if ($value === 'category') {
            if ($prop !== $this->initTag['category']) {
                $this->editTagContextChanged = true;
            }
        }
    }


    /**
     * Delete the tag
     *
     * @param  mixed $translationId
     * @return void
     */
    public function deleteTag()
    {
        $tag = Tag::find($this->selectedTagId);
        if ($tag) {
            $tag->delete(); // The Tag model has a listener that also deletes associates models
            $this->resetForm();
            $this->resetPage();
        }
        $this->modalDeleteTag = false;
    }


    /**
     * Delete the tag
     *
     * @param  mixed $translationId
     * @return void
     */
    public function updateTag()
    {
        $tag = Tag::find($this->selectedTagId);
        if ($tag) {
            // Update the tag name
            $tag->name = $this->editTag['name'];
            $tag->save();

            // Update the locale example
            $locale = $tag->locale()->first();
            if ($locale) {
                $locale->example = $this->editTag['example'];
                $locale->save();
            }
            // Update the context category_id
            $context = $tag->contexts()->first();
            if ($context) {
                $context->category_id = $this->editTag['category'];
                $context->save();
            }
            $this->resetForm();
            $this->resetPage();
        }

        // TODO wirui notification and transaction and validation!
        $this->modalEditTag = false;
    }


    public function resetForm()
    {
        $this->reset([
            'selectedTagId',
            'selectedTag',
            'modalDeleteTag',
            'modalEditTag',
            'countTotal',
            'countTotalContext',
            'editTagChanged',
            'editTagContextChanged',
        ]);
    }


    public function updatedPerPage($value)
    {
        $this->resetPage();
    }


    public function searchTags()
    {
        $this->resetPage(); // Reset pagination to the first page
    }



    public function handleSearchEnter()
    {
        if (!$this->showModal) {
            $this->searchTags();
        }
    }



    public function resetSearch()
    {
        $this->search = '';
        $this->searchTags();
    }


    public function render()
    {

        $tagsQuery = Tag::orderBy('updated_at', 'desc');

        if ($this->search) {
            $tagsQuery->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('tag_id', 'like', '%' . $this->search . '%');
            });
        }
        $tags = $tagsQuery->paginate($this->perPage);


        // Flatten the entire $tags collection and include categories in each locale
        $flattenedTags = $tags->getCollection()->flatMap(function ($tag) {
            return $tag->locales->sortByDesc('updated_at')->map(function ($locale) use ($tag) {
                $locale->categories = $tag->categories->first();
                return $locale;
            });
        });
        // Replace the original collection with the flattened collection
        $tags->setCollection($flattenedTags);
        // Filter for distinct tag_id records as the translation attribute will multiply results
        $uniqueTags = $flattenedTags->unique('tag_id')->values();
        // Replace the original collection with the filtered collection
        $tags->setCollection($uniqueTags);


        return view('livewire.tags.manage', [
            'tags' => $tags
        ]);
    }
}
