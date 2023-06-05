<?php

namespace App\Http\Livewire\Dashboard;


use App\Models\Image;
use App\Models\Locations\Location;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class News extends Component
{
    public $author;
    public $post = [];
    public $images = [];


    public function mount(Request $request)
    {
        $location_id = User::find($request->user()->id)->locations->all()[0]['pivot']['location_id'];
        $city_id = Location::find($location_id)->cities->all()[0]['pivot']['city_id'];
        // TODO: check what happens with ciy_id, when multiple locations per user are used!
        // $dd($city_id);
        $news_city_id = [$city_id]; // This should become an array [300,305]
        $post =collect(
            Post::with([
            'postable' => function ($query) {
                $query->select(['id', 'name', 'email']);
            },
            'category' => function ($query) use ($news_city_id) {
                $query->where('city_id', $news_city_id);
            },
            'translations' => function ($query) {
                $query
                ->where('locale', App::getLocale())->whereDate('published_at', '<=', now())
                ->orderBy('updated_at', 'desc');
            }
            ])
            ->firstOrFail()
            )->all();


            if ($post['category']) {

                $this->author = collect([
                    'postable_id' => $post['postable_id'],
                    'postable_type' => $post['postable_type'],
                    'name' => $post['postable']['name'],
                ]);

                if ($post['translations']) {
                    $this->post = collect($post['translations'][0]);
                    $this->post['published_at'] =Carbon::createFromTimeStamp(strtotime($this->post['published_at']))->isoFormat('LL');
                    $this->post['category'] = $post['category']['name'];
                }

                // TODO: Update when multiple posts are fetched!
                //TODO: Test when post has no images!
                $this->images = Storage::url(Image::find($post['id'])->path);

            }
    }


    public function render()
    {
        return view('livewire.dashboard.news');
    }
}
