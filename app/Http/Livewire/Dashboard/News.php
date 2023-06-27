<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Locations\Location;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class News extends Component
{
    public $author;
    public $post = [];
    public $media;


    public function mount(Request $request)
    {
        $type = substr(strrchr(get_class($this), '\\'), 1); // Get class name without namespace, used to query correct Post type
        $location_id = User::find($request->user()->id)->locations->all()[0]['pivot']['location_id'];
        $city_id = Location::find($location_id)->cities->all()[0]['pivot']['city_id'];
        // TODO: check what happens with ciy_id, when multiple locations per user are used!
        // $dd($city_id);
        $city_id = [$city_id]; // This should become an array [300,305] for use with multiple city locations
        $post =
            Post::with([
            'postable' => function ($query) {
                $query->select(['id', 'name', 'email']);
            },
            'category' => function ($query) use ($type, $city_id) {
                $query->where('type', $type)->where('city_id', $city_id);
            },
            'translations' => function ($query) {
                $query
                ->where('locale', App::getLocale())
                ->whereDate('start', '<=', now())
                ->where( function($query) {
                    $query->whereDate('stop', '>', now())->orWhereNull('stop');
                })
                ->orderBy('updated_at', 'desc');
            },
            'media' => function ($query) {
                $query->where('collection_name', 'post_image');
            },
            ])
            ->firstOrFail()
        ;

        if ($post->category) {      // Show only posts if it has the category type of this model's class

            $this->author = $post->postable->name;

            if ($post->translations->first()) {
                $this->post = $post->translations->first();
                $this->post['start'] = Carbon::createFromTimeStamp(strtotime($this->post->start))->isoFormat('LL');
                $this->post['category'] = Category::find($post->category_id)->translations->where('locale', App::getLocale())->first()->name;

                if ($post->media) {
                    $this->media = Post::find($post->id)->getFirstMedia('posts');
                    // $this->post['caption'] = "TODO: move me to single post page";
                    // dd($this->post['image']);
                }
            }
        }
    }


    public function render()
    {
        return view('livewire.dashboard.news');
    }
}
