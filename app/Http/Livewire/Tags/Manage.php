<?php

namespace App\Http\Livewire\Tags;

use App\Models\Category;
use App\Models\Tag;
use App\Models\TaggableLocaleContext;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class Manage extends Component
{
    use WithPagination;
    use WireUiActions;

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
 
    public $perPage = 10; // default 10 results per page

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
        try {
            $tag = Tag::find($this->selectedTagId);
            if ($tag) {
                $tag->delete(); // The Tag model has a listener that also deletes associates models
                $this->resetForm();
                $this->resetPage();

                $this->notification()->success(
                    $title = __('Deleted'),
                    $description = __('Tag') . ' ' . __('was deleted successfully!')
                );
            } else {
                $this->notification()->error(
                    $title = __('Error!'),
                    $description = __('Tag not found.')
                );
            }
        } catch (\Exception $e) {
            $this->notification()->error(
                $title = __('Error!'),
                $description = __('Oops, could not delete the') . ' ' . __('tag') . '!' . $e->getMessage()
            );
        }
        $this->resetPage(); 
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
        try {
            DB::transaction(function () {
                $tag = Tag::find($this->selectedTagId);
                if ($tag) {
                    $tag->name = $this->editTag['name'];
                    $tag->save();

                    $locale = $tag->locale()->first();
                    if ($locale) {
                        $locale->example = $this->editTag['example'];
                        $locale->save();
                    }

                    $context = $tag->contexts()->first();
                    if ($context) {
                        $context->category_id = $this->editTag['category'];
                        $context->save();
                    }

                    $this->resetForm();
                    $this->resetPage();
                }

                $this->notification()->success(
                    $title = __('Saved'),
                    $description = __('Tag').' '.__('is saved successfully!')
                );

                $this->modalEditTag = false;
            });
        } catch (Exception $e) {
            $this->notification()->error(
                $title = __('Error!'),
                $description = __('Oops, we have an error: the tag was not saved!').' '.$e->getMessage()
            );
            return back();
        }
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

    public function updatingPerPage()
    {
        $this->resetPage();
    }


    public function searchTags()
    {
        $this->resetPage();
    }


    public function handleSearchEnter()
    {
        if (!$this->showModal) {
            $this->searchTags();
            $this->resetPage(); 
        }
    }


    public function resetSearch()
    {
        $this->search = '';
        $this->searchTags();
    }

    public function render()
    {
                // Base query
        $tagsQuery = Tag::orderBy('updated_at', 'desc');

        // Apply search
        if ($this->search) {
            $tagsQuery->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('tag_id', 'like', '%' . $this->search . '%');
            });
        }
        
        // Standard Livewire pagination
        $tagsPaginator = $tagsQuery->paginate($this->perPage);


        return view('livewire.tags.manage', [
            'tags' => $tagsPaginator,
        ]);
    }
}
