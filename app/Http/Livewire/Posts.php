<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public $search;
    public $showModal = false;
    public $createTranslation;
    public $postId;
    public $categoryId;
    public $translationId;
    public $post;
    public $localeInit;
    public $locale;
    public $localeExclude = [];
    public $start;   // x-date-time-picker and x-select do not entangle if they do not exsist beforehand
    public $stop;     // x-date-time-picker and x-select do not entangle if they do not exsist beforehand

    protected $paginationTheme = 'tailwind';

    protected $listeners = ['languageToParent', 'categoryToParent'];

    protected $rules = [
        'locale' => 'required|string',
        'categoryId' => 'required|integer',
        'post.title' => 'required|string|min:3|max:150',
        // 'post.slug' => 'required|string',
        'post.excerpt' => 'required|string|max:300',
        'post.content' => 'required|string',
        'start' => 'date|nullable',
        'stop' => 'date|nullable',
    ];

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
        } else if ($value !== $this->localeInit) {
            $this->locale = $value;
            $this->createTranslation = true;
        }

    }


    public function categoryToParent($value)
    {
        $this->categoryId = $value;
        $this->categoryId = $value;

    }


    public function edit($translationId)
    {
        $this->showModal = true;
        $this->createTranslation = false;
        $this->postId = PostTranslation::find($translationId)->post_id;

        $post = Post::with(['translations' => function ($query) use ($translationId) {
            $query->where('id', $translationId);
        }])->find($this->postId)->toArray();

        $this->post = [
            'translation_id' => $post['translations'][0]['id'],
            'locale' => $post['translations'][0]['locale'],
            'title' => $post['translations'][0]['title'],
            'slug' => $post['translations'][0]['slug'],
            'excerpt' => $post['translations'][0]['excerpt'],
            'content' => $post['translations'][0]['content'],
        ];

        $this->localeInit = $post['translations'][0]['locale'];
        $this->locale = $post['translations'][0]['locale'];

        // Exclude exsisting translations but include initial locale from LanguageSelectbox
        $this->localeExclude = Post::find($this->postId)->translations()->whereNot('locale', $this->localeInit)->pluck('locale');

        $this->categoryId = $post['category_id'];
        $this->start = $post['translations'][0]['start'];   // x-date-time-picker and x-select need a separate public property, see start of this file
        $this->stop = $post['translations'][0]['stop']; // x-date-time-picker and x-select need a separate public property, see start of this file
    }


    public function create()
    {
        $this->reset();
        $this->showModal = true;
    }

    // TODO: author in translation table! with updates when saved
    public function save()
    {
        $this->validate();

        if (!is_null($this->postId)) {
            // Add translation to post
            if ($this->createTranslation === true) {

                $post = Post::find($this->postId);

                $translation = new PostTranslation([
                    'slug' => 'TODO-slug',
                    'locale' => $this->locale,
                    'title' => $this->post['title'],
                    'excerpt' => $this->post['excerpt'],
                    'content' => $this->post['content'],
                    'start' => $this->start,
                    'stop' => $this->stop,
                    ]);
                $post->translations()->save($translation);

            } else {
                // Update a post
                $post = Post::find($this->postId);
                $postTranslation = [
                    'title' => $this->post['title'],
                    'slug' => 'TODO-slug',
                    'content' => $this->post['content'],
                    'start' => $this->start,
                    'stop' => $this->stop,
                    ];
                $post->translations()->where('id', $this->post['translation_id'])->update($postTranslation);

                $post->category_id = $this->categoryId;
                $post->postable_id = Session('activeProfileId');
                $post->postable_type = Session('activeProfileType');
                $post->save();
            }
        } else {
            // Create a new post
            $post = new Post(['postable_id' => Session('activeProfileId'),
                            'postable_type' => Session('activeProfileType'),
                            'category_id' => $this->categoryId]);
            $post->save();

            $translation = new PostTranslation([
                'slug' => 'TODO-slug',
                'locale' => $this->locale,
                'title' => $this->post['title'],
                'excerpt' => $this->post['excerpt'],
                'content' => $this->post['content'],
                'start' => $this->start,
                'stop' => $this->stop,
                ]);
            $post->translations()->save($translation);
        }
        $this->createTranslation = false;
        $this->showModal = false;
    }


    public function close()
    {
        $this->createTranslation = false;
        $this->showModal = false;
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
