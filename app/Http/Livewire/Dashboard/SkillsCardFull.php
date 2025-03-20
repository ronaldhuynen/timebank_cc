<?php

namespace App\Http\Livewire\Dashboard;

use App\Helpers\StringHelper;
use App\Http\Livewire\Dashboard;
use App\Jobs\SendEmailNewTag;
use App\Models\Category;
use App\Models\Tag;
use App\Models\TaggableLocale;
use App\Traits\TaggableWithLocale;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Throwable;
use WireUi\Traits\WireUiActions;

class SkillsCardFull extends Component
{
    use TaggableWithLocale;
    use WireUiActions;

    public $tagsArray = [];
    public $initTagIds = [];
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

    public bool $sessionLanguageOk = false;
    public bool $sessionLanguageIgnored = false;
    public bool $baseLanguageOk = false;

    protected $langDetector = null;
    protected $listeners = ['save', 'cancelCreateTag', 'refreshComponent' => '$refresh'];

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
                [
                    'sometimes',
                    'required',
                    'string',
                    'min:3',
                    'max:80',
                    function ($attribute, $value, $fail) {
                        if (!preg_match('/\S+\s+\S+/', $value)) {
                            // If the input doesn't have at least 2 words, fail the validation for this field
                            $fail(__('The :attribute must be at least 2 words.'));
                        }
                    },
                    function ($attribute, $value, $fail) {
                        if (!$this->sessionLanguageOk && !$this->sessionLanguageIgnored) {
                            $currentLocale = app()->getLocale();
                            $locale = \Locale::getDisplayName($currentLocale, $currentLocale);
                            $fail(__('We can not detect that this is in :locale. You can ignore this validation below.', ['locale' => $locale]));
                        }
                    },
                ],
            ),
            'newTagCategory' => Rule::when(
                function ($input) {
                    // Check if newTag is not an empty array
                    return count($input['newTag']) > 0;
                },
                ['required', 'int'],
            ),
            'selectTagTranslation' => Rule::when(
                function ($input) {
                    // Check if existing tag translation is selected
                    return $this->translationVisible === true && $this->translateRadioButton == 'select';
                },
                ['required', 'int'],
            ),
            'inputTagTranslation' => 'array',
            'inputTagTranslation.name' => Rule::when(
                function ($input) {
                    // Check if existing tag translation is selected
                    return $this->translationVisible === true && $this->translateRadioButton == 'input';
                },
                [
                    'required',
                    'string',
                    'min:3',
                    'max:80',
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
                ],
            ),
        ];
    }

    public function mount()
    {
        $this->getSuggestions();
        $this->getInitialTags();
        $this->getLanguageDetector();
        $this->dispatch('load');

    }

    protected function getSuggestions()
    {
        $suggestions = (new Tag())->localTagArray(app()->getLocale());

        $this->suggestions = collect($suggestions)->map(function ($value) {
            return StringHelper::DutchTitleCase($value);
        });
    }

    protected function getInitialTags()
    {
        $this->initTagIds = getActiveProfile()->tags()->get()->pluck('tag_id');

        $this->initTagsArray = TaggableLocale::whereIn('taggable_tag_id', $this->initTagIds)
            ->select('taggable_tag_id', 'locale', 'updated_by_user')
            ->get()
            ->toArray();

        $translatedTags = collect((new Tag())->translateTagIdsWithContexts($this->initTagIds));

        $tags = $translatedTags->map(function ($item, $key) {
            return [
                'original_tag_id' => $item['original_tag_id'],
                'tag_id' => $item['tag_id'],
                'value' => $item['tag'],
                'readonly' => $item['locale'] == App::getLocale() ? false : true, // Mark all tags in a foreign language read-only, as users need to switch locale to edit/update/etc foreign tags
                'locale' => $item['locale'],
                'category' => $item['category'],
                'category_path' => $item['category_path'],
                'category_color' => $item['category_color'],
                'title' => $item['category_path'], // 'title' is used by Tagify script for text that shows on hover
                'style' =>
                    '--tag-bg:' .
                    tailwindColorToHex($item['category_color'] . '-300') .
                    '; --tag-text-color:#111827' . // #111827 is gray-900
                    '; --tag-hover:' .
                    tailwindColorToHex($item['category_color'] . '-200'), // 'style' is used by Tagify script for background color, tailwindColorToHex is a helper function in app/Helpers/StyleHelper.php
            ];
        });

        $tags = $tags->sortBy('category_color')->values();
        $this->initTagsArrayTranslated = $tags->toArray();
        $this->tagsArray = json_encode($tags->toArray());
    }

    public function checkSessionLanguage()
    {
        // Ensure the language detector is initialized
        $this->getLanguageDetector();

        $detectedLanguage = $this->langDetector->detectSimple($this->newTag['name']);
        if ($detectedLanguage === session('locale')) {
            $this->sessionLanguageOk = true;
            // No need to ignore language detection when session locale is detected
            $this->sessionLanguageIgnored = false;
        } else {
            $this->sessionLanguageOk = false;
        }

        $this->validateOnly('newTag.name');
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

        // Check if name is the profiles's session's locale
        $this->checkSessionLanguage();
        $this->newTagsArray = $this->initTagsArray;
        $this->newTag['name'] = StringHelper::DutchTitleCase($this->newTag['name']);


        if (app()->getLocale() != config('timebank-cc.base_language')) {
            $this->translationVisible = true;
        }

    }

    public function updatedSessionLanguageIgnored()
    {
        if (!$this->sessionLanguageIgnored) {
            $this->checkSessionLanguage();
        }

        // Revalidate the newTag.name field
        $this->validateOnly('newTag.name');
    }


    public function updatedNewTagCategory()
    {
        $this->selectTagTranslation = [];
        // Suggest related tags in base language (English) and possibly based on the category of the new tag
        $this->translationOptions = $this->relatedTag(null, config('timebank-cc.base_language'));
    }


    public function updatedInputTagTranslationName()
    {
        $this->resetErrorBag('inputTagTranslation.name');
        $this->inputTagTranslation['name'] = StringHelper::DutchTitleCase($this->inputTagTranslation['name']);
    }



    public function updatedTagsArray()
    {
        $this->newTagsArray = collect(json_decode($this->tagsArray, true));

        $localesToCheck = [app()->getLocale(), '']; // Only current locale and tags without locale should be checked for any new tag keywords
        $newTagsArrayLocal = $this->newTagsArray->whereIn('locale', $localesToCheck);
        // map suggestion to lower case for search normalization of the $newEntries
        $suggestions = collect($this->suggestions)->map(function ($value) {
            return strtolower($value);
        });
        // Retrieve new tag entries not present in suggestions
        $newEntries = $newTagsArrayLocal->filter(function ($newItem) use ($suggestions) {
            return !$suggestions->contains(strtolower($newItem['value']));
        });
        // Add a new skill modal if there are new entries
        if (count($newEntries) > 0) {
            $this->newTag['name'] = app()->getLocale() == 'de' ? $newEntries->flatten()->first() : ucfirst($newEntries->flatten()->first());           
            $this->categoryOptions = Category::where('type', Tag::class)
                ->get()
                ->map(function ($category) {
                    // Include all attributes, including appended ones
                    return [
                        'category_id' => $category->id,
                        'name' => ucfirst($category->translation->name ?? ''), // Use the appended 'translation' attribute
                        'relatedPathTranslation' => $category->relatedPathTranslation ?? '', // Appended attribute
                        'relatedColor' => $category->relatedColor ?? '', // Appended attribute
                    ];
                    //TODO NEXT: Now that we also have related path and color, include this in blade component
                })
                ->sortBy('name')
                ->values();
            $this->modalVisible = true;
            $this->checkSessionLanguage();

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
        if ($this->translateRadioButton === 'select') {
            $this->inputDisabled = true;
            $this->dispatch('disableInput');
        } elseif ($this->translateRadioButton === 'input') {
            $this->inputDisabled = false;
            $this->dispatch('disableSelect'); // Script inside view skills-form.blade.php
        }
    }


    public function updatedSelectTagTranslation()
    {
        $this->translateRadioButton = 'select';
        $this->inputDisabled = true;
        $this->dispatch('disableInput'); // Script inside view skills-form.blade.php
    }


    /**
     * Handles the update of input tag translation.
     *
     * Sets the translateRadioButton to 'input', enables input fields by setting inputDisabled to false,
     * and dispatches a 'disableSelect' event to disable certain selections in the frontend.
     */
    public function updatedInputTagTranslation()
    {
        $this->translateRadioButton = 'input';
        $this->inputDisabled = false;
        $this->dispatch('disableSelect'); // Script inside view skills-form.blade.php
    }


    /**
     * Updates the visibility of the modal. If the modal becomes invisible, dispatches the 'remove' event to remove the last value of the tags array on the front-end.
     */
    public function updatedModalVisible()
    {
        if ($this->modalVisible == false) {
            $this->dispatch('remove'); // Removes last value of the tagsArray on front-end only
            $this->dispatch('reinitializeComponent');
        }
    }


    /**
     * Retrieves a list of related tags based on the specified category and locale.
     *
     * @param int|null $category The ID of the category to filter related tags. If null, all tags in the locale are suggested.
     * @param string|null $locale The locale to use for tag names. If not provided, the application's current locale is used.
     *
     * @return \Illuminate\Support\Collection A collection of tags containing 'tag_id' and 'name' keys, sorted by name.
     */
    public function relatedTag($category, $locale = null)
    {
        if (!$locale) {
            $locale = app()->getLocale();
        }
        if ($category) {
            // A category is given: suggest related tags (family bloodline) within this category in $locale language
            $related = Category::find($category)->bloodline->pluck('id');

            $suggestions = Tag::with(['locale', 'contexts'])
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
                        'name' => StringHelper::DutchTitleCase($name),
                    ];
                })
                ->sortBy('name')
                ->values();
        } else {
            // No category is selected: suggest all tags in $locale language
            $suggestions = Tag::with(['locale', 'contexts'])
                ->whereHas('locale', function ($query) use ($locale) {
                    $query->where('locale', $locale);
                })
                ->pluck('normalized', 'tag_id')
                ->map(function ($name, $index) {
                    return [
                        'tag_id' => $index,
                        'name' => StringHelper::DutchTitleCase($name),
                    ];
                })
                ->sortBy('name')
                ->values();
        }
        return $suggestions;
    }


    /**
     * Cancels the creation of a new tag by resetting error messages,
     * clearing input fields, hiding translation and modal visibility,
     * and resetting tag arrays to their initial state.
     */
    public function cancelCreateTag()
    {
        $this->resetErrorBag();
        $this->newTag = [];
        $this->newTagCategory = null;
        $this->translationVisible = false;
        $this->newTagsArray = $this->initTagsArray;
        $this->tagsArray = json_encode($this->initTagsArray);
        $this->modalVisible = false;
        $this->updatedModalVisible();
    }



    public function createTag()
    {
        $this->validate();
        $this->resetErrorBag();

        $owner = getActiveProfile();
        $owner->tag($this->newTag['name']);
        $name = $this->newTag['name'];

        $tag = Tag::whereHas('locale', function ($query) {
            $query->where('locale', app()->getLocale());
        })
            ->where('name', $name)
            ->first();

        $context = [
            'category_id' => $this->newTagCategory,
            'updated_by_user' => auth()->user()->id,
        ];

        if ($this->translateRadioButton === 'select') {
            // Attach an existing context in the base language to the new tag. See config('timebank-cc.base_language')
            // Note that the category_id and updated_by_user is not updated when selecting an existing context
            $tagContext = Tag::find($this->selectTagTranslation)
                ->contexts()
                ->first();
            $tag->contexts()->attach($tagContext->id);
        } elseif ($this->translateRadioButton === 'input') {
            // Create a new context for the new tag
            $tagContext = $tag->contexts()->create($context);

            // Create a new base language translation of the tag
            $owner->tag($this->inputTagTranslation['name']);
            $nameTranslation = $this->inputTagTranslation['name'];
            $tagTranslation = Tag::where('name', $nameTranslation)->first();
            $locale = [
                'locale' => config('timebank-cc.base_language'),
            ];
            $tagTranslationLocale = $tagTranslation->locale()->update($locale);

            // Attach the context to the new tag and the translation
            $tag->contexts()->attach($tagContext->id);
            $tagTranslation->contexts()->attach($tagContext->id);

            // The translation now has been recorded. Next, detach owner from this translation as only the locale tag should be attached to the owner
            $owner->untagById([$tagTranslation->tag_id]);
            // Also clean up owner's tags that have similar context but have different locale. Only the tag in owner's app()->getLocale() should remain in db.
            $owner->cleanTaggables();

        } else {
            // Create a new context for the new tag without translation
            $tagContext = $tag->contexts()->create($context);
        }

        // Update newTagsArray with the new tag for save method
        $this->newTagsArray = collect($this->newTagsArray)->transform(function ($item) {
            if (isset($item['value']) && $item['value'] === $this->newTag['name']) {
                $item['locale'] = app()->getLocale();
            }
            return $item;
            // dd($this->newTagsArray);
        });

        $this->save();
        $this->modalVisible = false;

        // Dispatch the SendEmailNewTag job
        SendEmailNewTag::dispatch($tag->tag_id);
    }


    /**
     * Saves the newTagsArray: attaches the current tags to the profile model.
     * Ignores the tags that are marked read-only (no app locale and no base language locale).
     * Dispatches notification on success or error.
     *
     * @return void
     */
    public function save()
    {
        if ($this->newTagsArray) {
            try {
                // Use a transaction for saving skill tags
                DB::transaction(function () {
                    // Make sure we can count newTag for conditional validation rules
                    if ($this->newTag === null) {
                        $this->newTag = [];
                    }

                    $owner = getActiveProfile();

                    $this->validate();
                    $this->resetErrorBag();

                    // Select (to exclude) initial tags in other locales to remove possible tags with a similar context but with different locales
                    $initTagIds = collect($this->initTagsArray)->pluck('taggable_tag_id');

                    // Select foreign tags that are (initially) read-only and that have no translation in current user locale.
                    if (count($this->initTagsArray) > 0) {
                        $retagReadOnly = collect($this->initTagsArrayTranslated)
                            ->where('readonly', true)  // should be true
                            ->pluck('original_tag_id')
                            ->toArray();
                        $retagForeign = implode(', ', $retagReadOnly);
                        $untagForeign = $initTagIds->diff($retagReadOnly);
                        // untag the result of the selection(s), the tags marked read-only are not untagged
                        $owner->untagById($untagForeign);
                    }
                    // Select the new tags: without the ones stored in only a foreign language as a user should always switch locale to input another language.
                    $this->newTagsArray = collect($this->newTagsArray);
                    $tag = $this->newTagsArray->where('readonly', '<>', true)->pluck('value')->toArray();
                    // dd($tag);
                    $owner->tag($tag);

                    // WireUI notification
                    $this->notification()->success($title = __('Your have updated your profile successfully!'));
                });
                // end of transaction
            } catch (Throwable $e) {
                // WireUI notification
                // TODO!: create event to send error notification to admin
                $this->notification([
                    'title' => __('Update failed!'),
                    'description' => __('Sorry, your data could not be saved!') . '<br /><br />' . __('Our team has ben notified about this error. Please try again later.') . '<br /><br />' . $e->getMessage(),
                    'icon' => 'error',
                    'timeout' => 100000,
                ]);
            }
            $this->dispatch('saved');
            $this->forgetCachedSkills();
            $this->cacheSkills();
            $this->initTagsArray = [];
            $this->newTag = null;
            $this->newTagsArray = null;
            $this->newTagCategory = null;
            $this->dispatch('refreshComponent');
            $this->dispatch('reinitializeTagify');
            $this->dispatch('reloadPage');
        }
    }


    public function forgetCachedSkills()
    {
        // Get the profile type (user / organization) from the session and convert to lowercase
        $profileType = strtolower(basename(str_replace('\\', '/', session('activeProfileType'))));
        // Get the supported locales from the config
        $locales = config('app.supported_locales', [app()->getLocale()]);
        // Iterate over each locale and forget the cache
        foreach ($locales as $locale) {
            Cache::forget('skills-' . $profileType . '-' . session('activeProfileId') . '-lang-' . $locale);
        }
    }


    public function cacheSkills()
    {
        $profileType = strtolower(basename(str_replace('\\', '/', session('activeProfileType')))); // Get the profile type (user / organization) from the session and convert to lowercase

        $skillsCache = Cache::remember('skills-' . $profileType . '-' . session('activeProfileId') . '-lang-' . app()->getLocale(), now()->addDays(7), function () {
            // remember cache for 7 days
            $tagIds = session('activeProfileType')::find(session('activeProfileId'))->tags->pluck('tag_id');
            $translatedTags = collect((new Tag())->translateTagIdsWithContexts($tagIds, App::getLocale(), App::getFallbackLocale())); // Translate to app locale, if not available to fallback locale, if not available do not translate
            $skills = $translatedTags->map(function ($item, $key) {
                return [
                    'original_tag_id' => $item['original_tag_id'],
                    'tag_id' => $item['tag_id'],
                    'name' => $item['tag'],
                    'foreign' => $item['locale'] == App::getLocale() ? false : true, // Mark all tags in a foreign language read-only, as users need to switch locale to edit/update/etc foreign tags
                    'locale' => $item['locale'],
                    'category' => $item['category'],
                    'category_path' => $item['category_path'],
                    'category_color' => $item['category_color'],
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
