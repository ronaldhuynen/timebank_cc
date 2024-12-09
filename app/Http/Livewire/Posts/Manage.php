<?php

namespace App\Http\Livewire\Posts;

use App\Models\Category;
use App\Models\Meeting;
use App\Models\Post;
use App\Models\PostTranslation;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class Manage extends Component
{
    use WithPagination;
    use WithFileUploads;
    use WireUiActions;
    use HandlesAuthorization;



    public $search;
    public bool $showModal = false;
    public $createTranslation;
    public $postId;
    public $bulkSelected = [];
    public bool $bulkDisabled = true;
    public $categoryId;
    public $post = ['excerpt' => '','content' => ''];   // In case fields are left empty (concept post)

    public $localeInit;
    public $locale;
    public $localesOptions = [];
    public $language;

    public $title;
    public $content;
    public $from;   // x-date-time-picker and x-select do not entangle if they do not exist beforehand
    public $till;     // x-date-time-picker and x-select do not entangle if they do not exist beforehand
    public $modalStopPublication = false;
    public $selectedTranslationId = null;    // Needed for the stopPublicationModal

    public $image;
    public $imageCaption = '';  // TODO! Make image caption field
    public $media;

    public $meetingShow = false;
    public $meeting;
    public $meetingAddress;
    public $meetingFrom;
    public $meetingTill;
    public $organizerOptions;
    public $organizer = ['id' => null, 'type' => null]; // In case fields are left empty (concept post)

    public $perPage = 10;

    protected $listeners = ['categorySelected', 'localeSelected', 'quillEditor', 'uploadImage', 'organizerSelected'];

    protected function rules()
    {
        //  Note that most fields are not required, this is to store concept posts
        //  TODO: make certain fields required when publish start date is selected?
        return [
        'categoryId' => 'required|integer',
        'locale' => 'required|string',
        'post.slug' =>  [
            'required', 'string', 'min:3', 'max:150', 'regex:/^[\pL\pM\pN-]+$/u',
            Rule::unique('post_translations', 'slug')->ignore($this->post['translation_id'], 'id')],
        'post.title' => 'required|string|min:3|max:150',
        'post.excerpt' => 'string|max:300',
        'content' => 'string|nullable',
        'from' => 'date|nullable',
        'till' => 'date|nullable',
        'image' => 'nullable|image|max:5120',
        'meetingFrom' =>  'date|nullable',
        'meetingTill' =>  'date|nullable',
        'meeting.address' => 'string|max:100|nullable',
        'organizer.id' => 'integer|nullable',
        'organizer.type' => 'string|nullable',
    ];
    }


    public function mount()
    {
        $this->checkAccess();
    }

    protected function checkAccess()
    {
        $user = auth()->user();
        if (
            session('activeProfileType') != 'App\Models\Admin' ||
            !$user->can('manage posts')
        ) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function categorySelected($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->getLocalesOptions();
        $isMeeting = Category::where('id', $this->categoryId)->where('type', Meeting::class)->exists();
        if ($isMeeting) {
            if ($this->postId) {    // Check if we are editing an existing post or if we are creating a new one
                $this->getMeeting();
                $this->meetingShow = true;
            }
            $this->meetingShow = true;
        } else {
            $this->meetingShow = false;
        }
    }


    /**
    * Get available language options for the language select-box
    *
    * @return void
    */
    public function getLocalesOptions()
    {
        // Ensure categoryId is set
        if (!$this->categoryId) {
            $this->localesOptions = [];
            return;
        }

        // Get available translations for the selected category
        $localesOptions = Category::with(['translations' => function ($query) {
            $query->select('category_id', 'locale');
        }])->find($this->categoryId);

        // Edit a post: exclude existing translations but include initial locale
        if ($this->postId) {
            $localesExclude = Post::find($this->postId)->translations()->whereNot('locale', $this->localeInit)->pluck('locale');
        } else {
            // Create a post
            $localesExclude = [];
        }

        if ($localesOptions) {
            $localesOptions = $localesOptions->translations()->pluck('locale');
            $this->localesOptions = $localesOptions->diff($localesExclude);
        } else {
            $this->localesOptions = [];
        }

        $this->dispatch('updateLocalesOptions', $localesOptions);
    }


    public function localeSelected($locale)
    {
        // Edit the initial post
        if ($locale === $this->localeInit) {
            $this->locale = $locale;
            $this->post['translation_id'] = Post::find($this->postId)->translations->first()->id;     // No new post, so restore post['translation_id] to ignore unique slug validation
            $this->createTranslation = false;
        } elseif ($locale !== $this->localeInit) {
            // Add a new translation to the initial post
            $this->locale = $locale;
            $this->post['translation_id'] = null;   // New post, so reset post['translation_id'] for unique slug validation
            $this->createTranslation = true;
        }
        $this->setLanguageName();
    }


    public function setLanguageName()
    {
        if ($this->locale) {
            $this->language = DB::table('languages')->where('lang_code', $this->locale)->first()->name;
        }
    }


    public function organizerSelected($value)
    {
        $this->organizer = $value;
    }


    public function updatedTitle($value)
    {
        $this->post['title'] = $value;
        $this->post['slug'] = SlugService::createSlug(PostTranslation::class, 'slug', $value);
    }


    public function edit($translationId)
    {
        $this->meetingShow = false;     // Hide the event details unless an event category is selected
        $this->createTranslation = false;
        $this->postId = PostTranslation::find($translationId)->post_id;

        $post = Post::with(['translations' => function ($query) use ($translationId) {
            $query->where('id', $translationId);
        },
        'category' => function ($query) {
            $query->with('translations');
        },
        'meeting',
        ])->find($this->postId);

        $this->post = [
            'category_id' => $post->category_id,
            'translation_id' => $post->translations->first()->id,
            'locale' => $post->translations->first()->locale,
            'title' => $post->translations->first()->title,
            'slug' => $post->translations->first()->slug,
            'excerpt' => $post->translations->first()->excerpt,
            'content' => $post->translations->first()->content,
        ];
        if ($post->meeting) {
            $this->getMeeting();
        }

        $this->title = $this->post['title'];
        $this->content = $this->post['content'];

        $this->localeInit = $this->post['locale'];
        $this->locale = $this->post['locale'];
        $this->setLanguageName();

        $this->categoryId = $post->category_id;
        $this->getLocalesOptions();
        $this->meetingShow = Category::where('id', $post->category_id)->where('type', Meeting::class)->exists();    // Toggle meeting section based on category type

        $this->from = $post->translations->first()->from;   // x-date-time-picker and x-select need a separate public property, see start of this file
        $this->till = $post->translations->first()->till; // x-date-time-picker and x-select need a separate public property, see start of this file

        if ($post->media->count() > 0) {
            $this->media = $post->getFirstMediaUrl('posts');    // Do not use responsive media in livewire pages that have multiple update cycles as the placeholder img show after an update
        }

        $this->showModal = true;

    }


    public function create()
    {
        $this->reset();
        $this->dispatch('showModal');
        $this->showModal = true;
    }


    public function save()
    {
        // Add translation to post
        if (!is_null($this->postId)) {

            $this->validate();

            if ($this->createTranslation === true) {

                $post = Post::find($this->postId);

                $postTranslation = new PostTranslation([
                    'slug' => $this->post['slug'],
                    'locale' => $this->locale,
                    'title' => $this->post['title'],
                    'excerpt' => $this->post['excerpt'],
                    'content' => $this->content,
                    'updated_by_user_id' => auth()->id(),
                    'from' => $this->from,
                    'till' => $this->till,
                    ]);
                $post->translations()->save($postTranslation);

                if ($this->meetingShow) {

                    $postMeeting = [
                        'post_id' => $this->postId,
                        'address' => $this->meetingAddress,
                        'meetingable_id' => $this->organizer['id'],
                        'meetingable_type' => $this->organizer['type'],
                        'from' => $this->meetingFrom,
                        'till' => $this->meetingTill
                        ];
                    Meeting::updateOrCreate(['post_id' =>  $this->postId], $postMeeting);
                }

                $this->saveMedia($post);

                // WireUI notification
                if ($post) {
                    $this->notification()->success(
                        $title = __('Saved'),
                        $description = __('Post is saved successfully')
                    );
                } else {
                    $this->notification()->error(
                        $title = __('Error!'),
                        $description = __('Oops, we have an error: the post was not saved!')
                    );
                    return back();
                }

            } else {
                // Update a post
                $this->validate();

                $post = Post::find($this->postId);
                $postTranslation = [
                    'title' => $this->post['title'],
                    'slug' => $this->post['slug'],
                    'excerpt' => $this->post['excerpt'],
                    'content' => $this->content,
                    'updated_by_user_id' => auth()->id(),
                    'from' => $this->from,
                    'till' => $this->till,
                    ];
                $post->translations()->where('id', $this->post['translation_id'])->update($postTranslation);
                $post->category_id = $this->categoryId;
                $post->postable_id = Session('activeProfileId'); // TODO check config
                $post->postable_type = Session('activeProfileType');

                if ($this->meetingShow) {
                    $postMeeting = [
                        'post_id' => $this->postId,
                        'address' => $this->meetingAddress,
                        'meetingable_id' => $this->organizer['id'],
                        'meetingable_type' => $this->organizer['type'],
                        'from' => $this->meetingFrom,
                        'till' => $this->meetingTill
                    ];
                    Meeting::updateOrCreate(['post_id' =>  $this->postId], $postMeeting);
                }

                $post->save();

                $this->saveMedia($post);

                // WireUI notification
                if ($post) {
                    $this->notification()->success(
                        $title = __('Saved'),
                        $description = __('Post is saved successfully')
                    );
                } else {
                    $this->notification()->error(
                        $title = __('Error!'),
                        $description = __('Oops, we have an error: the post was not saved!')
                    );
                    return back();
                }
            }
        } else {
            // Create a new post
            $this->post['translation_id'] = 0;   // for unique validation on slug: do not ignore non-existing translation_id
            $this->validate();

            if (config('timebank-cc.posts.postable_is_auth_user')) {
                // Authenicated users are stored as postables
                $post = new Post(['postable_id' => auth()->id(),   // Store creator (article writer) id
                                'postable_type' => get_class(auth()->user()),   // Store creator (article writer) type. I.e. "App\Models\User"
                                ]);
            } else {
                // Active profiles are stored as postables
                $post = new Post(['postable_id' => session('activeProfileId'),
                                'postable_type' => session('activeProfileType'),
                                ]);
            }
            $post['category_id'] = $this->categoryId;
            $post->save();

            $translation = new PostTranslation([
                'slug' => $this->post['slug'],
                'locale' => $this->locale,
                'title' => $this->post['title'],
                'excerpt' => $this->post['excerpt'],
                'content' => $this->content,
                'updated_by_user_id' => auth()->id(),
                'from' => $this->from,
                'till' => $this->till,
                ]);
            $post->translations()->save($translation);

            if ($this->meetingShow) {
                $postMeeting = [
                    'address' => $this->meetingAddress,
                    'meetingable_id' => $this->organizer['id'],
                    'meetingable_type' => $this->organizer['type'],
                    'from' => $this->meetingFrom,
                    'till' => $this->meetingTill
                    ];
                Meeting::updateOrCreate(['post_id' =>  $post->id], $postMeeting);
            }

            $this->saveMedia($post);

            // WireUI notification
            if ($post) {
                $this->notification()->success(
                    $title = __('Saved'),
                    $description = __('Post is saved successfully!')
                );
            } else {
                $this->notification()->error(
                    $title = __('Error!'),
                    $description = __('Oops, we have an error: the post was not saved!')
                );
                return back();
            }
        }
        $this->close();
    }


    public function saveMedia($post)
    {
        if ($this->image) {
            $post->clearMediaCollection('posts');
            $post->addMedia($this->image->getRealPath())
                ->withCustomProperties([
                    'caption' => $this->imageCaption,
                ])
                ->toMediaCollection('posts');
        }
    }


    /**
     * Receives value from livewire trix-editor component
     *
     * @param  mixed $value
     * @return void
     */
    public function quillEditor($content = null)
    {
        $this->content = $content;
    }


    public function updatedImage()
    {
        // info('updated image');
    }


    public function updatedBulkSelected()
    {
        if (count($this->bulkSelected) > 0) {
            $this->bulkDisabled = false;
        } else {
            $this->bulkDisabled = true;
        }
    }


    public function deleteSelected()
    {
        // Get the selected translations
        $selectedTranslations = PostTranslation::whereIn('id', $this->bulkSelected)->get();

        // Update the 'till' attribute to prevent immediate publication of restored posts
        $selectedTranslations->each(function ($translation) {
            $translation->update(['updated_by_user_id' => auth()->id(), 'till' => now()]);
        });

        // Delete the selected translations
        PostTranslation::whereIn('id', $this->bulkSelected)->delete();

        // Check if any posts have no remaining translations and if so, delete those posts
        $postIds = $selectedTranslations->pluck('post_id')->unique();
        foreach ($postIds as $postId) {
            $post = Post::withTrashed()->find($postId);
            if ($post && $post->translations()->count() === 0) {
                $post->delete();
            }
        }

        // Reset the bulk selection
        $this->bulkSelected = [];
        $this->bulkDisabled = true;
    }


    /**
     * Close the Edit post modal
     *
     * @return void
     */
    public function close()
    {
        $this->showModal = false;
        $this->resetForm();
    }


    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->mount();
    }


    /**
     * Get meeting details for the post
     *
     * @return void
     */
    public function getMeeting()
    {
        $this->meeting = collect(Meeting::where('post_id', $this->postId)->first());
        if ($this->meeting->isNotEmpty()) {
            $this->meetingAddress = $this->meeting['address'];
            $this->meetingFrom = $this->meeting['from'];    // WireUI is not (yet) able to bind nested properties
            $this->meetingTill = $this->meeting['till'];    // WireUI is not (yet) able to bind nested properties
            $this->organizer['id'] = $this->meeting['meetingable_id'];
            $this->organizer['type'] = $this->meeting['meetingable_type'];
            if ($this->organizer['id']) {
                $this->dispatch('organizerExists', $this->meeting);
            }
        }
    }


    public function openStopPublicationModal($translationId)
    {
        $this->selectedTranslationId = $translationId;
        $this->modalStopPublication = true;
    }


    /**
     * Stop publication of the post
     *
     * @param  mixed $translationId
     * @return void
     */
    public function stopPublication($translationId)
    {
        $translation = PostTranslation::find($translationId);
        if ($translation) {
            $translation->till = now();
            $translation->save();
            $this->resetForm();
        }
        $this->modalStopPublication = false;
    }


    public function updatedPerPage($value)
    {
        $this->resetPage();
    }


    public function render()
    {

        $locale = App::getLocale();
        $baseLocale = config('base_language');

        $posts = Post::with([
            'postable:id,name,email',
            'category', // Category translation is handled by the translation() accessor in the Post model. The blade file uses $post->category->translation
            'translations' => function ($query) {
                $query->with('updated_by_user:id,name,full_name,profile_photo_path');
            },
        ])
        ->latest()
        ->paginate($this->perPage);

        return view('livewire.posts.manage', [
            'posts' => $posts
        ]);

    }



}
