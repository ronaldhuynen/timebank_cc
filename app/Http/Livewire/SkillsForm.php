<?php

namespace App\Http\Livewire;

use App\Helpers\StringHelper;
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

    public $tagsArray = [];
    public $initialIds = [];
    public $initTagsArray = [];
    public $initTagsArrayTranslated = [];
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

    protected $listeners = ['save', 'cancelCreateTag'];

    protected function rules()
    {
        return [
            'newTagsArray' => 'array',
            // 'newTagsArray.*.value' => 'required|string|max:80|min:3',
            // 'newTagsArray.*.example' => 'string|max:200',
            // 'newTagsArray.*.locale' => 'string|max:6',
            'newTag' => 'array',
            'newTag.name' => 'sometimes|required|string|min:3|max:80',
            'newTag.example' => Rule::when(
                function ($input) {
                    // Check if newTag is not an empty array
                    return count($input['newTag']) > 0;
                },
                ['required', 'string','min:10', 'max:100']
            ),
            'newTag.check' => Rule::when(
                function ($input) {
                    // Check if newTag is not an empty array
                    return count($input['newTag']) > 0;
                },
                ['required', 'accepted']
            ),
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
        info('Mount initializes');

        $suggestions = (new Tag())->localTagArray(app()->getLocale());

        $this->suggestions = collect($suggestions)->map(function ($value) {
            return ucfirst($value);
        });

        //TODO! also test with organizations!
        $this->initialIds = session('activeProfileType')::find(session('activeProfileId'))
            ->tags()
            ->orderBy('name')
            ->get()
            ->pluck('tag_id');

        $this->initTagsArray = TaggableLocale::whereIn('taggable_tag_id', $this->initialIds)
            ->select('taggable_tag_id', 'locale', 'example', 'updated_by_user')
            ->get()->toArray();

        ds($this->initTagsArray)->label('$initTagsArray in mount()');

        $translatedIds = collect((new Tag())->translateTagIds($this->initialIds, App::getLocale(), App::getFallbackLocale()));     // Translate to app locale, if not available to fallback locale, if not available do not translate
        $translatedTags = Tag::orderBy('name')->find($translatedIds);

        $tags = $translatedTags->map(function ($item, $key) {

            $locale = TaggableLocale::where('taggable_tag_id', $item->tag_id)->get();

            return [
               'tag_id' => $item->tag_id,
               'value' => ucfirst($item->normalized),
               'readonly' => ($locale->first()->locale ==  App::getLocale()) ? false : true,    // Mark all tags in a foreign language read-only, as users need to switch locale to edit/update/etc foreign tags
               'title' =>  $locale->pluck('example')->first(),
               'locale' => $locale->pluck('locale')->first(),
               ];
        });


        $this->initTagsArrayTranslated = $tags->toArray();

        $this->tagsArray = json_encode($tags->toArray());

        ds($this->tagsArray)->label('$tagsArray in Mount')->color('red');
    }



    public function updatedNewTagName()
    {
        $this->newTag['name'] = StringHelper::DutchTitleCase($this->newTag['name']);
    }


    public function updatedNewTagExample()
    {
        $this->newTag['example'] = StringHelper::DutchTitleCase($this->newTag['example']);

        if (app()->getLocale() != config('timebank-cc.base_language')) {
            $this->translationVisible = true;
        }
    }

    public function updatedNewTagCategory()
    {
        // Suggest related tags in base language (English) and possibly based on the category of the new tag
        $this->translationOptions = $this->relatedTag($this->newTagCategory, config('timebank-cc.base_language'));
    }

    public function updatedInputTagTranslationName()
    {
        $this->inputTagTranslation['name'] = StringHelper::DutchTitleCase($this->inputTagTranslation['name']);
    }


    public function updatedInputTagTranslationExample()
    {
        $this->inputTagTranslation['example'] = StringHelper::DutchTitleCase($this->inputTagTranslation['example']);
    }


    public function updatingTagsArray()  // Note this is updating, not updated, as Tagify catches the json too soon.
    {
        $this->tagsArray = json_encode(json_decode($this->tagsArray));    // re-encode the json
    }


    public function updatedTagsArray()
    {
        $this->newTagsArray = collect(json_decode($this->tagsArray, true));
        ds($this->newTagsArray)->label('$newTagsArray in updatedTagsArray')->color('red');

        $localesToCheck = [app()->getLocale(), ''];     // Only current locale and tags without locale should be checked for any new tag keywords
        $newTagsArrayLocal = $this->newTagsArray->whereIn('locale', $localesToCheck);

        $suggestions = collect($this->suggestions);
        // Retrieve new tag entries not present in suggestions
        $newEntries = $newTagsArrayLocal->filter(function ($newItem) use ($suggestions) {
            return !$suggestions->contains($newItem['value']);
        });

        // Add a new skill modal if there are new entries
        if (count($newEntries) > 0) {

            $this->newTag['name'] = ucfirst($newEntries->flatten()->first());


            $this->categoryOptions = Category::with(['translations' => function ($query) {
                $query->where('locale', app()->getLocale())->select('id', 'category_id', 'name');
            }])
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
                        'category_id' => $index, // +1 removed!
                        'name' => ucfirst($name)
                    ];
                })
                ->sortBy('name')->values();

// dsd($this->categoryOptions)->label('$categoryOptions in updatedTags')->color('red');


            $this->modalVisible = true;

        } else {
            $newEntries = false;
        }
    }


    public function updatedTranslateRadioButton()
    {
        if ($this->translateRadioButton === "select") {
            $this->inputDisabled = true;
            $this->emit('disableInput');
        } elseif ($this->translateRadioButton === "input") {
            $this->inputDisabled = false;
            $this->emit('disableSelect');   // Script inside view skills-form.blade.php
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

            info('with category');

            $related = Category::find($category)->bloodline->pluck('id');

            $test = Category::find($category)->bloodline();

            ds($test)->label('test')->color('green');


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
                    'tag_id' => $index,
                    'name' => ucfirst($name)
                ];
            })->sortBy('name')->values();

        } else {
            info('no category');
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
                    'tag_id' => $index,
                    'name' => ucfirst($name)
                ];
            })->sortBy('name')->values();

        }
        return $suggestions;
    }


    public function cancelCreateTag()
    {
        info('cancelCreateTag() fires!');
        $this->newTag = null;
        $this->newTagCategory = null;
        $this->translationVisible = false;

        $this->dispatchBrowserEvent('cancelCreateTag'); // Removes last value of the tagsArray on front-end only

        $this->newTagsArray = $this->initTagsArray;
        $this->tagsArray = json_encode($this->initTagsArray);

        $this->modalVisible = false;
    }


    public function createTag()
    {
        $this->validate();
        $this->resetErrorBag();

        $owner = session('activeProfileType')::find(session('activeProfileId'));
        $owner->tag($this->newTag['name']);
        $name = str_replace("-", " ", Str::slug($this->newTag['name']));  // Use the normalized name that is stored in db
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

        } elseif ($this->translateRadioButton === 'input') {

            // Create a new context for the new tag
            $tagContext = $tag->contexts()->create($context);

            // Create a new (English) translation of the tag
            $owner->tag($this->inputTagTranslation['name']);
            $nameTranslation = str_replace("-", " ", Str::slug($this->inputTagTranslation['name']));  // Use the normalized name that is stored in db
            $tagTranslation = Tag::where('name', $nameTranslation)->first();

            $locale = [
                'example' => $this->inputTagTranslation['example'],
                'locale' => config('timebank-cc.base_language'),
                ];
            $tagTranslationLocale = $tagTranslation->locale()->update($locale);

            // Attach the context to the new tag and the translation
            $tag->contexts()->attach($tagContext->id);
            $tagTranslation->contexts()->attach($tagContext->id);

        } else {

            // Create a new context for the new tag without translation
            $tagContext = $tag->contexts()->create($context);
        }

        // Update newTagsArray with the new tag for save method
        $this->newTagsArray->transform(function ($item, $key) {
            if (isset($item['value']) && $item['value'] === $this->newTag['name']) {
                $item['title'] = $this->newTag['example'];      //TODO replace title with example, check Tagify script ReadOnlyMix class for this?
                $item['locale'] = app()->getLocale();
            }
            return $item;
        });


        $this->newTag = null;
        // $this->newTagsArray = $this->initTagsArray;
        $this->newTagsArray = null;
        $this->tagsArray = json_encode($this->initTagsArray);

        $this->modalVisible = false;
        $this->save();
    }


    /**
     * Update the user's skill tags information.
     *
     * @return void
     */
    public function save()
    {
        if ($this->newTagsArray) {
            if (count($this->newTagsArray) > 0) {

                // Make sure we can count newTag for conditional validation rules
                if ($this->newTag === null) {
                    $this->newTag = [];
                }

                $owner = session('activeProfileType')::find(session('activeProfileId'));

                $this->validate();
                $this->resetErrorBag();

                // Select (to exclude) initial tags in other locales to remove possible tags with a similar context but with different locales
                $untagForeign = collect($this->initTagsArray)->pluck('taggable_tag_id');

                ds($untagForeign)->label('$untagForeign in save()');

                // Select (to include) foreign tags that are (initially) read-only and that have no translation in current user locale.
                if (count($this->initTagsArray) > 0) {
                    $retagReadOnly = collect($this->initTagsArrayTranslated)->where('readonly', true)->pluck('tag_id')->toArray();

                    ds($retagReadOnly)->label('$retagReadOnly in save()');
                    $retagForeign = (implode(", ", $retagReadOnly));
                    $untagForeign = $untagForeign->diff($retagReadOnly);
                }
                // untag the result of the selection(s), the tags marked read-only are not untagged
                $owner->untagById($untagForeign);
                ds($untagForeign)->label('$untagForeignResult in save()');

                // Select the new tags: without the ones stored in only a foreign language as a user should always switch locale to input another language.
                $this->newTagsArray = collect($this->newTagsArray);
                $tag = $this->newTagsArray->where('readonly', '<>', true)->pluck('value')->toArray();

                ds($tag)->label('$tag in save()');
                $owner->tag($tag);
            }
        }
        $this->initTagsArray = [];
        $this->emit('saved');
    }




    public function render()
    {
        return view('livewire.skills-form');
    }
}
