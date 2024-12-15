<?php

namespace App\Http\Livewire\Welcome;

use App\Models\Post;
use Illuminate\Support\Facades\App;
use Livewire\Component;


class LandingPost extends Component
{
    public $type;
    public bool $random;
    public int $limit;

    
    public function mount($type, $sticky = null, $random = null, $limit = null)
    {
        $this->type = $type;
        $this->random = $random ?? false;
        $this->limit = $limit ?? 1;
    }


    public function render()
    {
        $locale = App::getLocale();
        
        // Random post
        if ($this->random) {

            $posts = Post::with([
                'category',
                'translations' => function ($query) use ($locale) {
                    $query->where('locale', $locale)
                        ->orderBy('created_at', 'desc')
                        ->limit($this->limit);
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
            ->inRandomOrder()
            ->limit($this->limit)
            ->get(); // Execute the query to get a Collection of posts

            } else {

            // Latest post first
            $posts = Post::with([
                'category',
                'images' => function ($query) {
                    $query->select('images.id', 'caption', 'path');
                },
                'translations' => function ($query) use ($locale) {
                    $query->where('locale', $locale)
                        ->orderBy('created_at', 'desc')
                        ->limit($this->limit);
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
        }

        $photo = null;
        if ($posts->isNotEmpty()) {
            $firstPost = $posts->first(); // Get the first post from the collection
            if ($firstPost->hasMedia('*')) { // Now, hasMedia() is called on a Post instance
                $photo = $firstPost->getFirstMedia('*')->getUrl();
            }
        }

        return view('livewire.welcome.landing-post', [
            'posts' => $posts,
            'photo' => $photo,
        ]);
    }

}
