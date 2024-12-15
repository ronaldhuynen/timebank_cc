<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class SidePost extends Component
{
    public $type;
    public bool $sticky = false;
    public bool $random = false;
    public bool $latest = false;

    public function mount($type, $sticky = null, $random = null, $latest = null)
    {
        $this->type = $type;

        if ($sticky) {
            $this->sticky = true;
        }
        if ($random) {
            $this->random = true;
        }
        if ($latest) {
            $this->latest = true;
        }
    }


    public function render()
    {
        // Sticky post
        if ($this->sticky) {
            $locale = App::getLocale();

            $posts = Post::with([
                'category',
                'images' => function ($query) {
                    $query->select('images.id', 'caption', 'path');
                },
                'translations' => function ($query) use ($locale) {
                    $query->where('locale', $locale)
                        ->orderBy('created_at', 'desc')
                        ->limit(3);
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
            ->limit(3)
            ->first();
        }


        // Random post
        if ($this->random) {
            $locale = App::getLocale();

            $posts = Post::with([
                'category',
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
            ->inRandomOrder() // This replaces the orderBy() method
            ->first();
        }

        // Latest post
        if ($this->latest) {
            $locale = App::getLocale();

            $posts = Post::with([
                'category',
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
            ->first();
        }
        
        $thumbnail = null;
        if ($posts) {
            if ($posts->hasMedia('*')) {
                $thumbnail = $posts->getFirstMedia('*')->getUrl();
            }        
        }

        return view('livewire.side-post', [
            'posts' => $posts,
            'thumbnail' => $thumbnail,
        ]);
    }
}
