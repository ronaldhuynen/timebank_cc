<?php

namespace App\Http\Livewire\Dashboard;

use App\Helpers\StringHelper;
use App\Models\Category;
use App\Models\Tag;
use App\Models\TaggableLocale;
use App\Traits\TaggableWithLocale;
use Cviebrock\EloquentTaggable\Services\TagService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Throwable;
use WireUi\Traits\Actions;

class SkillsCardFull extends Component
{
    use TaggableWithLocale;
    use Actions;

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

    public $baseLanguageOk = null;
    public $sessionLanguageOk = null;

    protected $langDetector = null;
    protected $listeners = ['save', 'cancelCreateTag'];


    protected function rules()
    {
        return [
            'newTagsArray' => 'array',
            'newTag' => 'array',
            'newTag.name' => Rule::when(
                function ($input) {
                    // Check if newTag is not an empty array
                    return count($input['newTag']) > 0;
                },
                [    'sometimes', 'required', 'string', 'min:3', 'max:80',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/\S+\s+\S+/', $value)) {
                            // If the input doesn't have at least 2 words, fail the validation for this field
                            $fail(__('The :attribute must be at least 2 words.'));
                        }
                    },
                    function ($attribute, $value, $fail) {
                        if ($this->sessionLanguageOk !== true) {
                            $currentLocale = app()->getLocale();
                            $locale = \Locale::getDisplayName($currentLocale, $currentLocale);
                            $fail(__('We can not detect that this is in :locale. Check also your example below.', ['locale' => $locale]));
                        }
                    },
                ]
            ),
            'newTag.example' => Rule::when(
                function ($input) {
                    // Check if newTag is not an empty array
                    return count($input['newTag']) > 0;
                },
                [
                    'required', 'string', 'min:10', 'max:100',
                    function ($attribute, $value, $fail) {
                        if ($this->sessionLanguageOk !== true) {

                            $currentLocale = app()->getLocale();
                            $locale = \Locale::getDisplayName($currentLocale, $currentLocale);
                            $fail(__('We can not detect that this is in :locale. Try to use more words.', ['locale' => $locale]));
                        }
                    },
                ]
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
                [
                    'required', 'string', 'min:3', 'max:80',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/\S+\s+\S+/', $value)) {
                            // If the input doesn't have at least 2 words, fail the validation for this field
                            $fail(__('The :attribute must be at least 2 words.', ['attribute' => $attribute]));
                        }
                    },
                    function ($attribute, $value, $fail) {
                        if ($this->baseLanguageOk !== true) {
                            $baseLocale = config('timebank-cc.base_language');
                            $currentLocale = app()->getLocale();
                            $locale = \Locale::getDisplayName($baseLocale, $currentLocale);
                            // If baseLanguageOk is not true, fail the validation for this field
                            $fail(__('We can not detect that this is in :locale , please modify.', ['locale' => $locale]));
                        }
                    },

                ]
            ),
            'inputTagTranslation.example' => Rule::when(
                function ($input) {
                    // Check if existing tag translation is selected
                    return ($this->translationVisible === true && $this->translateRadioButton == 'input');
                },
                [
                    'required', 'string', 'min:10', 'max:100',
                    function ($attribute, $value, $fail) {
                        if ($this->baseLanguageOk !== true) {
                            $baseLocale = config('timebank-cc.base_language');
                            $currentLocale = app()->getLocale();
                            $locale = \Locale::getDisplayName($baseLocale, $currentLocale);
                            // If baseLanguageOk is not true, fail the validation for this field
                            $fail(__('We can not detect that this is in :locale , please modify.', ['locale' => $locale]));
                        }
                    },


                ]
            ),

        ];
    }


    public function mount()
    {
        $suggestions = (new Tag())->localTagArray(app()->getLocale());

        $this->suggestions = collect($suggestions)->map(function ($value) {
            return StringHelper::DutchTitleCase($value);
        });

        $this->initialIds = session('activeProfileType')::find(session('activeProfileId'))
            ->tags()
            ->orderBy('name')
            ->get()
            ->pluck('tag_id');

        $this->initTagsArray = TaggableLocale::whereIn('taggable_tag_id', $this->initialIds)
            ->select('taggable_tag_id', 'locale', 'example', 'updated_by_user')
            ->get()->toArray();

        $translatedTags = collect((new Tag())->translateTagIdsWithContexts($this->initialIds, App::getLocale(), App::getFallbackLocale()));     // Translate to app locale, if not available to fallback locale, if not available do not translate

        $tags = $translatedTags->map(function ($item, $key) {

            return [
                'tag_id' => $item['tag_id'],
                'value' => $item['tag'],
                'readonly' => ($item['locale']['locale'] ==  App::getLocale()) ? false : true,    // Mark all tags in a foreign language read-only, as users need to switch locale to edit/update/etc foreign tags
                'locale' => $item['locale']['locale'],
                'example' =>  $item['locale']['example'],
                'category' => $item['category'],
                'category_path' =>  $item['category_path'],
                'category_color' =>  $item['category_color'],
                'title' =>  $item['category_path'],     // 'title' is used by Tagify script for text that shows on hover
                'style' =>  '--tag-bg:' . tailwindColorToHex($item['category_color'] . '-300') .
                    '; --tag-text-color:#111827' . // #111827 is gray-900
                    '; --tag-hover:' . tailwindColorToHex($item['category_color'] . '-200'),   // 'style' is used by Tagify script for background color, tailwindColorToHex is a helper function in app/Helpers/StyleHelper.php
            ];
        });

        $tags = $tags->sortBy('category_color')->values();
        $this->initTagsArrayTranslated = $tags->toArray();
        $this->tagsArray = json_encode($tags->toArray());
        $this->dispatchBrowserEvent('load');
    }


    protected function getLanguageDetector()
    {
        if (!$this->langDetector) {
            $this->langDetector = new \Text_LanguageDetect();
            $this->langDetector->setNameMode(2); // iso language code with 2 characters
        }
        return $this->langDetector;
    }


    public function updatedNewTagName()
    {
        $this->resetErrorBag('newTag.name');
        $this->newTagsArray = $this->initTagsArray;
        $this->newTag['name'] = StringHelper::DutchTitleCase($this->newTag['name']);
    }


    public function updatedNewTagExample()
    {
        $this->resetErrorBag('newTag.example');
        $this->newTag['example'] = StringHelper::DutchTitleCase($this->newTag['example']);

        $langDetector = $this->getLanguageDetector();
        $detectedLanguage = $langDetector->detectSimple($this->newTag['name'] . ' ' . $this->newTag['example']);
        if ($detectedLanguage === session('locale')) {
            $this->sessionLanguageOk = true;
        } else {
            $this->sessionLanguageOk = false;
        }

        if (app()->getLocale() != config('timebank-cc.base_language')) {
            $this->translationVisible = true;
        }
    }


    public function updatedNewTagCategory()
    {
        $this->selectTagTranslation = [];
        // Suggest related tags in base language (English) and possibly based on the category of the new tag
        $this->translationOptions = $this->relatedTag($this->newTagCategory, config('timebank-cc.base_language'));
    }


    public function updatedInputTagTranslationName()
    {
        $this->resetErrorBag('inputTagTranslation.name');
        $this->inputTagTranslation['name'] = StringHelper::DutchTitleCase($this->inputTagTranslation['name']);
    }


    public function updatedInputTagTranslationExample()
    {
        $this->resetErrorBag('inputTagTranslation.example');
        $langDetector = $this->getLanguageDetector();
        $this->inputTagTranslation['name'] ?? $this->inputTagTranslation['name'] = "";
        $detectedLanguage = $langDetector->detectSimple($this->inputTagTranslation['name'] . ' ' . $this->inputTagTranslation['example']);
        if ($detectedLanguage === config('timebank-cc.base_language')) {
            $this->baseLanguageOk = true;
        } else {
            $this->baseLanguageOk = false;
        }
        $this->inputTagTranslation['example'] = StringHelper::DutchTitleCase($this->inputTagTranslation['example']);
    }


    public function updatingTagsArray()  // Note this is updating, not updated, as Tagify catches the json too soon.
    {
        // $this->tagsArray = json_encode(json_decode($this->tagsArray));    // re-encode the json
    }


    public function updatedTagsArray()
    {
        $this->newTagsArray = collect(json_decode($this->tagsArray, true));

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

            $this->modalVisible = true;
        } else {
            $newEntries = false;
        }
    }


    public function updatedTranslationVisible()
    {
        if ($this->translationVisible) {
            $this->updatedNewTagCategory();
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
            // A category is selected: suggest related tags (family bloodline) within this category in $locale language
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
                ->pluck('normalized', 'tag_id')
                ->map(function ($name, $index) {
                    return [
                        'tag_id' => $index,
                        'name' => StringHelper::DutchTitleCase($name)
                    ];
                })->sortBy('name')->values();
        } else {
            // No category is selected: suggest all tags in $locale language
            $suggestions = Tag::with([
                'locale',
                'contexts'
            ])
                ->whereHas('locale', function ($query) use ($locale) {
                    $query->where('locale', $locale);
                })
                ->pluck('normalized', 'tag_id')
                ->map(function ($name, $index) {
                    return [
                        'tag_id' => $index,
                        'name' => StringHelper::DutchTitleCase($name)
                    ];
                })->sortBy('name')->values();
        }
        return $suggestions;
    }


    public function cancelCreateTag()
    {
        $this->resetErrorBag();

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
        $name = str_replace("-", " ", (new TagService())->normalize($this->newTag['name']));  // Use the normalized name that is stored in db

        $tag = Tag::whereHas('locale', function ($query) {
            $query->where('locale', app()->getLocale());
        })->where('name', $name)->first();

        $locale = ['example' => $this->newTag['example']];
        $tagLocale = $tag->locale()->update($locale);
        $context = [
            'category_id' => $this->newTagCategory,
            'updated_by_user' => auth()->user()->id
        ];


        if ($this->translateRadioButton === 'select') {

            // Attach an existing context in the base language to the new tag. See config('timebank-cc.base_language')
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
        $this->newTagsArray = collect($this->newTagsArray)->transform(function ($item, $key) {
            if (isset($item['value']) && $item['value'] === $this->newTag['name']) {
                $item['title'] = $this->newTag['example'];
                $item['locale'] = app()->getLocale();
            }
            return $item;
        });

        $this->modalVisible = false;
        $this->save();
        // $this->reset();
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

                try {
                    // Use a transaction for saving skill tags
                    DB::transaction(function () {
                        // Make sure we can count newTag for conditional validation rules
                        if ($this->newTag === null) {
                            $this->newTag = [];
                        }

                        $owner = session('activeProfileType')::find(session('activeProfileId'));

                        $this->validate();
                        $this->resetErrorBag();

                        // Select (to exclude) initial tags in other locales to remove possible tags with a similar context but with different locales
                        $untagForeign = collect($this->initTagsArray)->pluck('taggable_tag_id');

                        // Select (to include) foreign tags that are (initially) read-only and that have no translation in current user locale.
                        if (count($this->initTagsArray) > 0) {
                            $retagReadOnly = collect($this->initTagsArrayTranslated)->where('readonly', true)->pluck('tag_id')->toArray();

                            $retagForeign = (implode(", ", $retagReadOnly));
                            $untagForeign = $untagForeign->diff($retagReadOnly);
                        }
                        // untag the result of the selection(s), the tags marked read-only are not untagged
                        $owner->untagById($untagForeign);

                        // Select the new tags: without the ones stored in only a foreign language as a user should always switch locale to input another language.
                        $this->newTagsArray = collect($this->newTagsArray);
                        $tag = $this->newTagsArray->where('readonly', '<>', true)->pluck('value')->toArray();

                        $owner->tag($tag);

                        // WireUI notification
                        $this->notification()->success(
                            $title = __('Your have updated your profile successfully!'),
                        );
                    });
                    // end of transaction

                } catch (Throwable $e) {

                    // WireUI notification
                    // TODO!: create event to send error notification to admin
                    $this->notification([
                        'title' => __('Update failed!'),
                        'description' => __('Sorry, your data could not be saved!') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
                        'icon' => 'error',
                        'timeout' => 100000
                    ]);
                }
            }
        }
        $this->initTagsArray = [];
        $this->forgetCachedSkills();
        $this->cacheSkills();
        $this->emit('saved');
        $this->newTag = null;
        $this->newTagsArray = null;
        $this->newTagCategory = null;
        $this->mount();
        $this->dispatchBrowserEvent('tagifyChange', ['tagsArray' => $this->tagsArray]);
    }


    public function forgetCachedSkills()
    {
        //  Remove cached skills for all supported locales of the active profile type.
        $localization = new LaravelLocalization();
        $profileType = strtolower(basename(str_replace('\\', '/', session('activeProfileType'))));  // Get the profile type (user / organization) from the session and convert to lowercase
        foreach (collect($localization->getSupportedLocales())->keys() as $locale) {
            Cache::forget('skills-' . $profileType . '-' . auth()->id() . '-lang-' . $locale);
        }
    }


    public function cacheSkills()
    {
        $profileType = strtolower(basename(str_replace('\\', '/', session('activeProfileType')))); // Get the profile type (user / organization) from the session and convert to lowercase

        $skillsCache = Cache::remember('skills-' . $profileType . '-' . session('activeProfileId') . '-lang-' . app()->getLocale(), now()->addDays(7), function () { // remember cache for 7 days
            $tagIds = session('activeProfileType')::find(session('activeProfileId'))->tags->pluck('tag_id');
            $translatedTags = collect((new Tag())->translateTagIdsWithContexts($tagIds, App::getLocale(), App::getFallbackLocale()));     // Translate to app locale, if not available to fallback locale, if not available do not translate
            $skills = $translatedTags->map(function ($item, $key) {
                return [
                    'tag_id' => $item['tag_id'],
                    'name' => $item['tag'],
                    'foreign' => ($item['locale']['locale'] ==  App::getLocale()) ? false : true,    // Mark all tags in a foreign language read-only, as users need to switch locale to edit/update/etc foreign tags
                    'locale' => $item['locale']['locale'],
                    'example' =>  $item['locale']['example'],
                    'category' => $item['category'],
                    'category_path' =>  $item['category_path'],
                    'category_color' =>  $item['category_color'],
                ];
            });
            $skills = collect($skills);

            return $skills;
        });

        $this->tagsArray = json_encode($skillsCache->toArray());
    }


    public function render()
    {
        return view('livewire.dashboard.skills-card-full');
    }
}