<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Meeting;
use App\Models\Post;
use App\Models\PostTranslation;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Posts extends Component
{
    use WithPagination;
    use WithFileUploads;
    use Actions;

    public $search;
    public $showModal = false;
    public $createTranslation;
    public $postId;
    public $bulkSelected = [];
    public $bulkDisabled = true;
    public $categoryId;
    public $post = ['excerpt' => '','content' => ''];   // In case fields are left empty (concept post)
    
    public $localeInit;
    public $locale;
    public $localesAvailable = [];
    public $language;

    public $title;
    public $content;
    public $start;   // x-date-time-picker and x-select do not entangle if they do not exist beforehand
    public $stop;     // x-date-time-picker and x-select do not entangle if they do not exist beforehand

    public $image;
    public $imageCaption = '';  // TODO! Make image caption field
    public $media;

    public $meetingShow = false;
    public $meeting;
    public $meetingFrom;
    public $meetingTill;
    public $organizerOptions;
    public $organizer = ['id' => null, 'type' => null]; // In case fields are left empty (concept post)

    protected $paginationTheme = 'tailwind';

    protected $listeners = ['categoryToParent', 'languageToParent', 'trixEditor', 'uploadImage', 'organizerSelected'];


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
        'start' => 'date|nullable',
        'stop' => 'date|nullable',
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
        $this->reset();
    }


    public function categoryToParent($value)
    {
        $this->categoryId = $value;
        $this->getLangOptions();
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


    public function languageToParent($value)
    {
        if ($value === $this->localeInit) {
            $this->locale = $value;
            $this->post['translation_id'] = Post::find($this->postId)->translations->first()->id;     // No new translation, so restore post['translation_id] to ignore unique slug validation
            $this->createTranslation = false;
        } elseif ($value !== $this->localeInit) {
            $this->locale = $value;
            $this->post['translation_id'] = null;   // New translation, so reset post['translation_id'] for unique slug validation
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
        $this->showModal = true;
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

        // Emit content to trix-editor component
        $this->emit('showModal', $this->post['content']);


        $this->title = $this->post['title'];
        $this->content = $this->post['content'];

        $this->localeInit = $this->post['locale'];
        $this->locale = $this->post['locale'];
        $this->setLanguageName();

        $this->categoryId = $post->category_id;
        $this->meetingShow = Category::where('id', $post->category_id)->where('type', Meeting::class)->exists();    // Toggle meeting section based on category type

        $this->getLangOptions();

        $this->start = $post->translations->first()->start;   // x-date-time-picker and x-select need a separate public property, see start of this file
        $this->stop = $post->translations->first()->stop; // x-date-time-picker and x-select need a separate public property, see start of this file

        if ($post->media->count() > 0) {
            $this->media = $post->getFirstMediaUrl('posts');    // Do not use responsive media in livewire pages that have multiple update cycles as the placeholder img show after an update
        }
    }


    public function create()
    {
        $this->reset();
        $this->emit('showModal');
        $this->showModal = true;
    }

    public function save()
    {
        if (!is_null($this->postId)) {

            // Add translation to post

            $this->validate();

            if ($this->createTranslation === true) {

                $post = Post::find($this->postId);

                $postTranslation = new PostTranslation([
                    'slug' => $this->post['slug'],
                    'locale' => $this->locale,
                    'title' => $this->post['title'],
                    'excerpt' => $this->post['excerpt'],
                    'content' => $this->content,
                    'start' => $this->start,
                    'stop' => $this->stop,
                    ]);
                $post->translations()->save($postTranslation);

                if ($this->meeting) {
                    
                    $postMeeting = [
                        'post_id' => $this->postId,
                        'address' => $this->meeting['address'],
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

                info('Update method: ' . $this->post['content']);

                $post = Post::find($this->postId);
                $postTranslation = [
                    'title' => $this->post['title'],
                    'slug' => $this->post['slug'],
                    'excerpt' => $this->post['excerpt'],
                    'content' => $this->content,
                    'start' => $this->start,
                    'stop' => $this->stop,
                    ];
                $post->translations()->where('id', $this->post['translation_id'])->update($postTranslation);
                $post->category_id = $this->categoryId;
                $post->postable_id = Session('activeProfileId');
                $post->postable_type = Session('activeProfileType');
                
                if ($this->meeting) {
                    $postMeeting = [
                        'post_id' => $this->postId,
                        'address' => $this->meeting['address'],
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

            $post = new Post(['postable_id' => Session('activeProfileId'),
                            'postable_type' => Session('activeProfileType'),
                            'category_id' => $this->categoryId]);
            $post->save();

            $translation = new PostTranslation([
                'slug' => $this->post['slug'],
                'locale' => $this->locale,
                'title' => $this->post['title'],
                'excerpt' => $this->post['excerpt'],
                'content' => $this->content,
                'start' => $this->start,
                'stop' => $this->stop,
                ]);
            $post->translations()->save($translation);

            if ($this->meeting) {
                $postMeeting = [
                    'address' => $this->meeting['address'],
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
    public function trixEditor($value = null)
    {
        info('trixEditor catch');
        $this->content = $value;
    }


    public function updatedImage()
    {
        info('updated image');
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
        $selected = PostTranslation::query()
            ->whereIn('id', $this->bulkSelected);
        $update = ['stop' => now()]; //set stop publication date at now() to prevent immediate publication of restored posts
        $selected->update($update);
        $selected->delete();

        $this->bulkSelected = [];
        $this->bulkDisabled = true;
    }


    /**
     * Close the modal
     *
     * @return void
     */
    public function close()
    {
        $this->showModal = false;
        $this->reset();
    }


    /**
    * Get available language options for the language select-box
    *
    * @return void
    */
    public function getLangOptions()
    {
        // Get available translations for the selected category
        $localesAvailable = Category::with(['translations' => function ($query) {
            $query->select('category_id', 'locale');
        }])->find($this->categoryId);

        // Exclude existing translations but include initial locale
        if ($this->postId) {
            $localesExclude = Post::find($this->postId)->translations()->whereNot('locale', $this->localeInit)->pluck('locale');
        } else {
            $localesExclude = [];
        }

        if ($localesAvailable) {
            $localesAvailable = $localesAvailable->translations()->pluck('locale');
            $this->localesAvailable = $localesAvailable->diff($localesExclude);
        } else {
            $this->localesAvailable = [];
        }
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
            $this->meetingFrom = $this->meeting['from'];    // WireUI is not (yet) able to bind nested properties
            $this->meetingTill = $this->meeting['till'];    // WireUI is not (yet) able to bind nested properties
            $this->organizer['id'] = $this->meeting['meetingable_id'];
            $this->organizer['type'] = $this->meeting['meetingable_type'];
            if ($this->organizer['id']) {    
                $this->emit('organizerExists', $this->meeting);
            }
        }
    }

    /**
     * Stop publication of the post
     *
     * @param  mixed $translationId
     * @return void
     */
    public function stop($translationId)
    {
        $translation = PostTranslation::find($translationId);
        if ($translation) {
            $stop['stop'] = now();
            $translation->update($stop);
        }
    }

    
    public function render()
    {
        $post = Post::with([
            'postable' => function ($query) {
                $query->select(['id', 'name', 'email']);
            },
            'category' => function ($query) {
                $query->with(['translations' => function ($query) {
                    $query->where('locale', App::getLocale());
                }]);
            },
            'translations' => function ($query) {
            },
            'images' => function ($query) {
                $query->select('images.id', 'caption', 'path');
            },
            ]);
        ;
        return view('livewire.posts.admin', [
            'posts' => $post->latest()->paginate(10)
        ]);
    }



}



