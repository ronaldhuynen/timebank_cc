<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostTranslation;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\App;
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
    public $showModal = flse;
    public $createTranslation;
    public $postId;
    public $bulkSelected = [];
    public bool $bulkDisabled = true;
    public $categoryId;
    public $post;
    public $localeInit;
    public $locale;
    public $localesAvailable = [];
    public $title;
    public $content;
    public $start;   // x-date-time-picker and x-select do not entangle if they do not exsist beforehand
    public $stop;     // x-date-time-picker and x-select do not entangle if they do not exsist beforehand

    public $image;
    public $imageCaption = '';
    public $media;

    protected $paginationTheme = 'tailwind';

    protected $listeners = ['languageToParent', 'categoryToParent', 'trixEditor', 'uploadImage'];


    protected function rules()
    {
        return [
        'categoryId' => 'required|integer',
        'locale' => 'required|string',
        'post.slug' =>  [
        'required', 'min:3', 'max:150',
        Rule::unique('post_translations', 'slug')->ignore($this->post['translation_id'], 'id')],
        'post.title' => 'required|string|min:3|max:150',
        'post.excerpt' => 'required|string|max:300',
        'post.content' => 'required|string|',
        'start' => 'date|nullable',
        'stop' => 'date|nullable',
        'image' => 'nullable|image|max:5120',
        ];
    }

    public function mount($value = '')
    {
        $this->reset();
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


    public function languageToParent($value)
    {
        if ($value === $this->localeInit) {
            $this->locale = $value;
            $this->createTranslation = false;
        } elseif ($value !== $this->localeInit) {
            $this->locale = $value;
            $this->createTranslation = true;
        }

    }


    public function categoryToParent($value)
    {
        $this->categoryId = $value;
        // HIERZO: language-selectbox reset
        // langoption moeten worden bijgewerkt
        //  refresh language-selectbox component?
    }


    public function updatedTitle($value)
    {
        $this->post['title'] = $value;
        $this->post['slug'] = SlugService::createSlug(PostTranslation::class, 'slug', $value);
    }


    public function edit($translationId)
    {
        $this->showModal = true;
        $this->createTranslation = false;
        $this->postId = PostTranslation::find($translationId)->post_id;

        $post = Post::with(['translations' => function ($query) use ($translationId) {
            $query->where('id', $translationId);
        },
        'category' => function ($query) {
            $query->with('translations');
        },
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


        // dd($this->media);

        // Emit content to trix-editor component
        // $this->emit('showModal', $this->post['content']);
        // $this->emit('showModal', $this->media = $post->getFirstMedia('post_image'));
        // $this->dispatchBrowserEvent('openModal', ['value' => $this->post['content']]);


        // Emit content to trix-editor component
        $this->emit('showModal', $this->post['content']);


        $this->title = $this->post['title'];
        $this->content = $this->post['content'];

        $this->localeInit = $this->post['locale'];
        $this->locale = $this->post['locale'];

        // Exclude exsisting translations but include initial locale from LanguageSelectbox
        $localesExclude = Post::find($this->postId)->translations()->whereNot('locale', $this->localeInit)->pluck('locale');
        info('localesExclude: ' .$localesExclude);
        // Exclude also languages that have no translation for the selected category
        $localesAvailable = $post->category->translations->pluck('locale');
        info('localesAvailable:' .$localesAvailable);
        $this->localesAvailable = $localesAvailable->diff($localesExclude);
        info('localesAvailable result:' .$localesAvailable);


        $this->categoryId = $post->category_id;
        $this->start = $post->translations->first()->start;   // x-date-time-picker and x-select need a separate public property, see start of this file
        $this->stop = $post->translations->first()->stop; // x-date-time-picker and x-select need a separate public property, see start of this file

        if ($post->media->count() > 0) {
            $this->media = $post->first()->getFirstMedia('posts')->img('4_3')->toHtml();
        }
    }


    public function create()
    {
        $this->reset();
        $this->emit('showModal');
        $this->showModal = true;
    }

    // TODO: author in translation table! with updates when saved
    public function save()
    {
        if (!is_null($this->postId)) {

            // Add translation to post

            $this->validate();

            if ($this->createTranslation === true) {

                $post = Post::find($this->postId);

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


                $this->saveMedia($post);

                // if ($this->image) {
                //                     $post->clearMediaCollection('posts');
                //     $post->addMedia($this->image->getRealPath())
                //         ->withCustomProperties([
                //             'caption' => $this->imageCaption,
                //         ])
                //         ->toMediaCollection('posts');
                // }


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
                $post->save();

                $this->saveMedia($post);


            }
        } else {

            // Create a new post

            $this->post['translation_id'] = 0;   // for unique validation on slug: do not ignore non-exsisting translation_id
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


            $this->saveMedia($post);

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
        // if ($this->image) {
        //     // dd($this->image);
        //     Image::load($this->image->path)
        //     ->focalCrop(3072, 2304, 50, 50)
        //     ->save();
        // }
        // return $this->image;
    }

    public function deleteSelected()
    {
        $selected = PostTranslation::query()
            ->whereIn('id', $this->bulkSelected);

        $update = ['stop' => now()]; //set stop publicaton date at now() to prevent immediate publication of restored posts
        $selected->update($update);

        $selected->delete();

        $this->bulkSelected = [];
    }


    public function close()
    {
        // $this->emit('file-pond-clear');
        $this->showModal = false;
        $this->reset();
    }


    public function stop($translationId)
    {
        $translation = PostTranslation::find($translationId);
        if ($translation) {
            $stop['stop'] = now();
            $translation->update($stop);
        }
    }
}
