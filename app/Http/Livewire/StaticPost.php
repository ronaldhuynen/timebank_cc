<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class StaticPost extends Component
{
    public $type;
    public int $limit;


    public function mount($type, $limit = 1)
    {
        $this->type = $type;

        if ($limit) {
            $this->limit = $limit;
        }
    }

    public function render()
    {
        $locale = App::getLocale();

        $posts = Post::with([
            'category',
            'images' => function ($query) {
                $query->select('images.id', 'caption', 'path');
            },
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale)
                    ->orderBy('created_at', 'desc')
                    ->limit(1);
            }
        ])
        ->whereHas('category', function ($query) {
            $query->where('type', $this->type);
        })
        ->whereHas('translations', function ($query) use ($locale) {
            $query->where('locale', $locale)
                ->whereDate('from', '<=', now())
                ->where(function ($query) {
                    $query->whereDate('till', '>', now())->orWhereNull('till');
                })
                ->orderBy('updated_at', 'desc');
        })
        ->orderBy('created_at', 'desc')
        ->limit($this->limit)
        ->get(); // Execute the query to get a Collection of posts


        $photo = null;
        if ($posts->isNotEmpty()) {
            $firstPost = $posts->first(); // Get the first post from the collection
            if ($firstPost->hasMedia('*')) { // Now, hasMedia() is called on a Post instance
                $photo = $firstPost->getFirstMedia('*')->getUrl();
            }
        }

        return view('livewire.static-post', [
            'posts' => $posts,
            'photo' => $photo,
        ]);
    }
}
