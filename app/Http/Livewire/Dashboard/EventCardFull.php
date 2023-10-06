<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Category;
use App\Models\Locations\City;
use App\Models\Locations\Country;
use App\Models\Locations\Division;
use App\Models\Locations\Location;
use App\Models\Meeting;
use App\Models\Post;
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
    public $related;


    public function mount($postNr, $related, Request $request)
    {
        $this->postNr = $postNr;
        $this->related = $related;

        $location = session('activeProfileType')::find(session('activeProfileId'))->locations->first->get();

        // If no division and no city as location set
        if (!$location->division && !$location->city) {
            $categoryable_id = Location::find($location->id)->country->id;
            $categoryable_type = Country::class;
            // Include also all other countries if $related is set in view
            if ($related) {
                $categoryable_id = Country::pluck('id');
            } else {
                $categoryable_id = [$categoryable_id];
            }
            // Division without city is set as location
        } elseif ($location->division && !$location->city) {
            $categoryable_id = Location::find($location->id)->division->id;
            $categoryable_type = Division::class;
            // Include also all other divisions in the same country if $related is set in view
            if ($related) {
                $categoryable_id = Division::find($categoryable_id)->parent->divisions->pluck('id');
            } else {
                $categoryable_id = [$categoryable_id];
            }
            // City is set as location
        } elseif ($location->city) {
            $categoryable_id = Location::find($location->id)->city->id;
            $categoryable_type = City::class;
            // Include also all other cities in the same division if $related is set in view
            if ($related) {
                $categoryable_id = City::find($categoryable_id)->parent->cities->pluck('id');
            } else {
                $categoryable_id = [$categoryable_id];
            }
            // No matching location is set
        } else {
            $categoryable_id = [];
            $categoryable_type = '';
        }

        // TODO: check what happens when multiple locations per user are used!

        $post =
            Post::with([
                'postable' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'category' => function ($query) use ($categoryable_id, $categoryable_type) {
                    $query
                    ->where('type', Meeting::class)
                    ->where(function ($query) use ($categoryable_id, $categoryable_type) {
                        $query
                            ->whereIn('categoryable_id', $categoryable_id)
                            ->where('categoryable_type', $categoryable_type);
                    });
                },
                'translations' => function ($query) {
                    $query
                        ->where('locale', App::getLocale())
                    ;
                },
                'meeting',
                'media',
                ])
                ->whereHas('category', function ($query) use ($categoryable_id, $categoryable_type) {
                    $query
                        ->where('type', Meeting::class)
                        ->where(function ($query) use ($categoryable_id, $categoryable_type) {
                            $query
                                ->whereIn('categoryable_id', $categoryable_id)
                                ->where('categoryable_type', $categoryable_type);
                        });
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
                ->get()->sortBy(function ($query) {
                    if (isset($query->meeting->from)) {
                        return $query->meeting->from;
                    };
                })->values();       // Use values() method to reset the collection keys after sortBy

        $lastNr = $post->count() - 1;

        if ($postNr > $lastNr) {
            $post = null;
        } else {
            $post = $post[$postNr];
        }

        if (isset($post->translations)) {
            $this->post = $post->translations->first();
            $this->post['start'] = Carbon::parse($post->translations->first()->updated_at)->isoFormat('LL');
            $this->post['category'] = Category::find($post->category_id)->translations->where('locale', App::getLocale())->first()->name;
            $this->post['author'] = $post->postable->name;
            if ($post->meeting) {
                $this->post['address'] = ($post->meeting->from) ? $post->meeting->address : '';
                $this->post['from'] = ($post->meeting->from) ? $post->meeting->from : '';
            }

            if ($post->media) {
                $this->media = Post::find($post->id)->getFirstMedia('posts');
            }
        }

    }



    public function render()
    {
        return view('livewire.dashboard.event-card-full');
    }
}
