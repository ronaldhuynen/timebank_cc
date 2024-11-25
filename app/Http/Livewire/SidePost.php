<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class SidePost extends Component
{
    public $type;

    
    public function mount($type)
    {
        $this->type = $type;
    }


    public function render()
    {

        $locale = App::getLocale();

        $posts = Post::with([
            'category' => function ($query) {
                $query->where('type', $this->type);
            },
            'images' => function ($query) {
                $query->select('images.id', 'caption', 'path');
            },
            'translations' => function ($query) use ($locale) {
                $query->where('locale', $locale)
                    ->orderBy('created_at', 'desc')
                    ->limit(3);
            }
        ])
        ->whereHas('translations', function ($query) use ($locale) {
            $query->where('locale', $locale);
        })
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        return view('livewire.side-post', [
            'posts' => $posts
        ]);
    }
}
