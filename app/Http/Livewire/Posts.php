<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    public $showModal = false;
    public $postId;
    public $translationId;
    public $post =[];
    public $start;   // x-date-time-picker and x-select do not entangle if they do not exsist beforehand
    public $stop;     // x-date-time-picker and x-select do not entangle if they do not exsist beforehand

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'post.title' => 'required|string|unique:users,name|min:3|max:150',
        'post.excerpt' => 'required|string|max:300',
        'post.content' => 'required|string',
        'start' => 'date|nullable',
        'stop' => 'date|nullable',
    ];

    public function render()
    {
        //TODO: code categories!
        $type = 'News';
        $city_id = 305;
        $post = Post::with([
            'postable' => function ($query) {
                $query->select(['id', 'name', 'email']);
            },
            'category' => function ($query) use ($type, $city_id) {
                $query->where('type', $type)->orWhere('city_id', $city_id);
            },
            'translations' => function ($query) {
                $query->where('locale', App::getLocale());
            },
            'images' => function ($query) {
                $query->select('images.id', 'caption', 'path');
            },
            ]);

        return view('livewire.posts.admin', [
            'posts' => $post->latest()->paginate(10)
        ]);
    }


    public function edit($postId)
    {
        $this->showModal = true;
        $this->postId = $postId;
        $post = Post::with(['category','translations' => function ($query) {
            $query->where('locale', App::getLocale());
        }])->find($postId)->toArray();
        $this->post = [
            'translation_id' => $post['translations'][0]['id'],
            'title' => $post['translations'][0]['title'],
            'excerpt' => $post['translations'][0]['excerpt'],
            'content' => $post['translations'][0]['content'],
            'locale' => $post['translations'][0]['locale'],
        ];
        $this->start = $post['translations'][0]['start'];   // x-date-time-picker and x-select need a separate public property, see start op file
        $this->stop = $post['translations'][0]['stop']; // x-date-time-picker and x-select need a separate public property, see start op file
    }


    public function create()
    {
        $this->showModal = true;
        $this->post = null;
        $this->postId = null;
    }


    public function save()
    {
        $this->validate();

        if (!is_null($this->postId)) {
            $post = Post::find($this->postId);
            $update = [
                'title' => $this->post['title'],
                'content' => $this->post['content'],
                'start' => $this->start,
                'stop' => $this->stop,
                ];
            $post->translations()->where('id', $this->post['translation_id'])->update($update);

        } else {
            Post::create($this->post);
        }
        $this->showModal = false;
    }


    public function close()
    {
        $this->showModal = false;
    }


    public function stop($translationId)
    {
        $translation = PostTranslation::find($translationId);
        // dd($post);
        if ($translation) {
            $stop['stop'] = now();
            $translation->update($stop);
        }
    }
}
