<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Tag;
use App\Models\TaggableLocale;
use App\Traits\TaggableWithLocale;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SkillsForm extends Component
{
    use TaggableWithLocale;

    public $tags = '';
    public $tagsArray = [];
    public $initTagsArray = [];
    public $newTagsArray;
    public $suggestions = [];

    public $modalVisible = false;
    public $translationVisible = false;

    public $newTag = [];
    public $newTagCategory;
    public $categoryOptions = [];
    public $translationOptions = [];

    public $selectTagTranslation;
    public $inputTagTranslation = [];
    public $inputDisabled = true;
    public $translateRadioButton = false;

    protected $listeners = ['save', 'refreshComponent' => '$refresh'];

    protected function rules()
    {
        return [
            'newTagsArray' => 'array',
            'newTagsArray.*.value' => 'required|string|max:50',
            'newTagsArray.*.example' => 'string|max:200',
            'newTagsArray.*.locale' => 'string|max:6',
            'newTag' => 'array',
            'newTag.name' => 'sometimes|required|string|max:50',
            'newTag.example' =>Rule::when(
                function ($input) {
                    // Check if newTag is not an empty array
                    return count($input['newTag']) > 0;
                },
                ['required', 'string','min:10', 'max:100'] 
                ),
            'newTag.check' => 'required_if:newTag.name,!=,|accepted',
            'newTagCategory' => Rule::when(
                function ($input) {
                    // Check if newTag is not an empty array
                    return count($input['newTag']) > 0;
                },
                ['required', 'int'] 
                ),
            'selectTagTranslation' => Rule::when(
                function ($input) {
                    // Check if existing tag translation is selected
                    return ($this->translationVisible === true && $this->translateRadioButton == 'select');
                },
                ['required', 'int'] 
                ),
            'inputTagTranslation' => 'array',
            'inputTagTranslation.name' => Rule::when(
                function ($input) {
                    // Check if existing tag translation is selected
                    return ($this->translationVisible === true && $this->translateRadioButton == 'input');
                },
                ['required', 'string', 'max:50'] 
                ),
            'inputTagTranslation.example' => Rule::when(
                function ($input) {
                    // Check if existing tag translation is selected
                    return ($this->translationVisible === true && $this->translateRadioButton == 'input');
                },
                ['required', 'string', 'min:10', 'max:100'] 
                ),
        ];
    }
    

    public function mount()
    {
        $this->suggestions = (new Tag())->localTagArray(app()->getLocale());

        $sourceIds = session('activeProfileType')::find(session('activeProfileId'))->tags()->get()->pluck('tag_id');

        $translatedIds = collect((new Tag())->translateTagIds($sourceIds, App::getLocale(), App::getFallbackLocale()));     // Translate to app locale, if not available to fallback locale, if not available do not translate
        $translatedTags = Tag::find($translatedIds);

        $tags = $translatedTags->map(function ($item, $key) {

            $locale = TaggableLocale::where('taggable_tag_id', $item->tag_id)->get();

            return [
               'value' => $item->normalized,
               'readonly' => ($locale->first()->locale ==  App::getLocale()) ? false : true,
               'title' =>  $locale->pluck('example')->first(),
               'locale' => $locale->pluck('locale')->first(),
               ];
        });

        $this->initTagsArray = $tags->toArray();
        $this->tagsArray = json_encode($this->initTagsArray);
        // dd($this->tagsArray);

        // $this->newTag = ['name' => null,
        //                 'category' => null,
        //                 'translation' => null,
        //                 ];
    }

    public function updating()  // Note this is not updated(), as tagify catches the json too soon.
    {
        $this->tagsArray = json_encode(json_decode($this->tagsArray));    // re-encode the json
    }

    public function updated()
    {
        $this->initTagsArray = collect($this->initTagsArray);
        $this->newTagsArray = collect(json_decode($this->tagsArray, true));

        $localesToCheck = [app()->getLocale(), '']; // Only current locale and tags without locale should be checked for any new tag keywords
        $newTagsArrayLocal = $this->newTagsArray->whereIn('locale', $localesToCheck);   

        // Check if in filtered newTagsArrayLocal a 'locale' key not exists
        $newEntryExist = $newTagsArrayLocal->contains(function ($item) {
            return !array_key_exists('locale', $item);
        });

        if ($newEntryExist) {
             $suggestions = collect($this->suggestions);
            // Retrieve new tag entries not present in suggestions
            $newEntries = $newTagsArrayLocal->filter(function ($newItem) use ($suggestions) {
                return !$suggestions->contains($newItem['value']);
            });

            // Add a new skill modal
            if (count($newEntries) > 0) {

                $this->newTag['name'] = $newEntries->flatten()->first();

                $this->categoryOptions = Category::with(['translations' => function ($query) {
                    $query->where('locale', app()->getLocale())->select('id', 'category_id', 'name');
                }])
                    ->whereHas('translations', function ($query) {
                        $query->where('locale', app()->getLocale());
                    })
                    ->where('type', Tag::class)
                    ->get()
                    ->flatMap(function ($category) {
                        return $category->translations->pluck('name', 'category_id');
                    })
                    ->map(function ($name, $index) {
                        return [
                            'category_id' => $index + 1,
                            'name' => $name
                        ];
                    })->sortBy('name')->values();

                // Suggest related tags in English and possibly based on the category of the new tag
                $this->translationOptions = $this->relatedTag($this->newTagCategory, 'en');

                $this->modalVisible = true;

            } else {
                $newEntries = false;
            }
        }
    }


    public function updatedTranslateRadioButton()
    {
        if ($this->translateRadioButton === "select") {
            $this->inputDisabled = true;
            $this->emit('disableInput');
        } elseif ($this->translateRadioButton === "input") {
            $this->inputDisabled = false;
            $this->emit('disableSelect');
        }
    }


    public function updatedSelectTagTranslation()
    {
        $this->translateRadioButton = "select";
        $this->inputDisabled = true;
        $this->emit('disableInput');    // Script inside view skills-form.blade.php
    }


    public function updatedInputTagTranslation()
    {
        $this->translateRadioButton = "input";
        $this->inputDisabled = false;       
        $this->emit('disableSelect');   // Script inside view skills-form.blade.php
    }



    public function relatedTag($category, $locale = null)
    {
        if (!$locale) {
            $locale = app()->getLocale();
        }

        if ($category) {
            $related = Category::find($category)->bloodline->pluck('id');

            $suggestions = Tag::with([
                'locale',
                'contexts'
            ])
            ->whereHas('locale', function ($query) use ($locale) {
                $query->whereIn('locale', [$locale]);
            })
            ->whereHas('contexts', function ($query) use ($related) {
                $query->whereIn('category_id', $related);
            })
            ->pluck('name', 'tag_id')
            ->map(function ($name, $index) {
                return [
                    'tag_id' => $index, // +1 removed!
                    'name' => $name
                ];
            })->sortBy('name')->values();
        } else {

            $suggestions = Tag::with([
                'locale',
                'contexts'
            ])
            ->whereHas('locale', function ($query) use ($locale) {
                $query->whereIn('locale', [$locale]);
            })
            ->pluck('name', 'tag_id')
            ->map(function ($name, $index) {
                return [
                    'tag_id' => $index, // +1 removed!
                    'name' => $name
                ];
            })->sortBy('name')->values();

        }
        return $suggestions;
    }


    /**
     * Update the user's skill tags information.
     *
     * @return void
     */
    public function save()
    {

        //TODO! bij alleen verwijderen van tags wordt er niets opgeslagen 


        $owner = session('activeProfileType')::find(session('activeProfileId'));

        
        // dd('before validation');
        $this->validate();
        $this->resetErrorBag();
        // dd('after validation');

        // Remove (untag) tags that are not read-only (use only tags in current language).
        $untag = $this->initTagsArray->where('readonly', '<>', true)->pluck('value')->toArray();
        $untag = (implode(", ", $untag));
        $owner->untag($untag);

        // Select the new tags: only the ones in the current language as a user should always switch locale to input another language.
        $tag = $this->newTagsArray->where('readonly', '<>', true)->where('locale', app()->getLocale())->pluck('value')->toArray();
        $tag = (implode(", ", $tag));
        $owner->tag($tag);

        // $this->newTagsArray = '';

        // } else {
        //     $this->resetErrorBag();
        //     $owner->detag();
        //     $this->tags = '';
        //     $this->tagsArray = [];

        // }
        // $this->tagsArray = $this->newTagsArray;
        // dd($this->tagsArray);

        // $this->reset($this->tagsArray);
        // $this->reset($this->initTagsArray);
        // $this->reset($this->newTagsArray);


        $this->emit('saved');

        // $this->emitSelf('refreshComponent');
        // $this->mount();
    }


    public function createTag()
    {
        $this->validate();
        $this->resetErrorBag();

        $owner = session('activeProfileType')::find(session('activeProfileId'));
        $owner->tag($this->newTag['name']);
        $name = str_replace("-", " ",Str::slug($this->newTag['name']));  // Use the normalized name that is stored in db
        $tag = Tag::where('name', $name)->first();


        $locale = ['example' => $this->newTag['example']];
        $tagLocale = $tag->locale()->update($locale);
        
        $context = [
            'category_id' => $this->newTagCategory,
            'updated_by_user' => auth()->user()->id
            ];

        
        if ($this->translateRadioButton === 'select') {

            // Attach an existing context (in English) to the new tag
            // Note that the category_id and updated_by_user is not updated when selecting an existing context!
            $tagContext = Tag::find($this->selectTagTranslation)->contexts()->first(); 
            $tag->contexts()->attach($tagContext->id);

            // Update newTagsArray with the new tag for save method
            $this->newTagsArray->transform(function ($item, $key) {
                if (isset($item['value']) && $item['value'] === $this->newTag['name']) {
                    $item['title'] = $this->newTag['example'];      //TODO replace title with example, check Tagify script ReadOnlyMix class for this?
                    $item['locale'] = app()->getLocale();
                }
                return $item;

            }); 
            
        } elseif ($this->translateRadioButton === 'input') {
                    
            // Create a new context for the new tag
            $tagContext = $tag->contexts()->create($context);

            // Create a new (English) translation of the tag
            $owner->tag($this->inputTagTranslation['name']);
            $nameTranslation = str_replace("-", " ", Str::slug($this->inputTagTranslation['name']));  // Use the normalized name that is stored in db
            $tagTranslation = Tag::where('name', $nameTranslation)->first();

            $locale = [
                'example' => $this->inputTagTranslation['example'],
                'locale' => 'en'
                ];
            $tagTranslationLocale = $tagTranslation->locale()->update($locale);   

            // Attach the context to the new tag
            $tag->contexts()->attach($tagContext->id);
            // Attach the context to the new translation tag
            $tagTranslation->contexts()->attach($tagContext->id);
            
        } else {            
        
            // Create a new context for the new tag without translation
            $tagContext = $tag->contexts()->create($context);
        }

        $this->modalVisible = false;
        
        $this->emit('saved');

    }


    public function render()
    {
        return view('livewire.skills-form');
    }
}
