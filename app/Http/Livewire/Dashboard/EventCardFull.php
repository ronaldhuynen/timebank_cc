<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Locations\Location;
use App\Models\Meeting;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class EventCardFull extends Component
{
    public $author;
    public $post = [];
    public $posts;
    public $media;
    public $postNr;


    public function mount($postNr, Request $request)
    {
        $this->postNr = $postNr;
        $location_id = User::find($request->user()->id)->locations->all()[0]['pivot']['location_id'];
        $city_id = Location::find($location_id)->cities->all()[0]['pivot']['city_id'];
        // TODO: check what happens with ciy_id, when multiple locations per user are used!
        // $dd($city_id);
        $city_id = [$city_id]; // This should become an array [300,305] for use with multiple city locations
        $post =
            Post::with([
                'postable' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'category',
                'translations',
                'meeting',
                'media',
                ])
                ->whereHas('category', function ($query) use ($city_id) {
                    $query->where('type', Meeting::class)->where('city_id', $city_id);
                })
                ->whereHas('translations', function ($query) {
                    $query
                    ->where('locale', App::getLocale())
                    ->whereDate('start', '<=', now())
                    ->where(function ($query) {
                        $query->whereDate('stop', '>', now())->orWhereNull('stop');
                    })
                    ->orderBy('updated_at', 'desc');
                })
                ->get();
                // dd($post);
        $lastNr = $post->count() -1;
        if ($postNr > $lastNr) {
            $post = null;
        } else {
            $post = $post[$postNr];
        }
        // dd(Carbon::parse($post->meeting->from));
        if ($post != null) {      // Show only posts if it has the category type of this model's class

            if ($post->translations->first()) {
                $this->post = $post->translations->first();
                $this->post['start'] = Carbon::parse($post->translations->first()->updated_at)->isoFormat('LL');
                $this->post['category'] = Category::find($post->category_id)->translations->where('locale', App::getLocale())->first()->name;
                $this->post['author'] = $post->postable->name;
                $this->post['address'] = $post->meeting->address;               
                $this->post['from'] = $post->meeting->from;



                if ($post->media) {
                    $this->media = Post::find($post->id)->getFirstMedia('posts');
                }
            }
        }
    }


    public function render()
    {
        return view('livewire.dashboard.event-card-full');
    }
}
