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
                $query->where('locale', $locale);
            })
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->first();
        }


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
                $query->where('locale', $locale);
            })
            ->inRandomOrder() // This replaces the orderBy() method
            ->first();
        }

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
                $query->where('locale', $locale);
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

        //TODO NEXT: Make sure than when a post category is not translated, the English name is shown, even when de browser is Spanish

        return view('livewire.side-post', [
            'posts' => $posts,
            'thumbnail' => $thumbnail,
        ]);
    }
}
