<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostTranslation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class PostController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showById($postId)
    {
        $post =
            Post::with([
            'postable' => function ($query) {
                $query->select(['id', 'name']);
            },
            'category'=> function ($query) {
                $query->with('translations');
            },
            'translations' => function ($query) {
                $query
                ->where('locale', App::getLocale());
                // ->whereDate('start', '<=', now())    //TODO: Exclude date queries only for post Admins!
                // ->where( function($query) {
                //     $query->whereDate('stop', '>', now())->orWhereNull('stop');
                // })
            },
            ])
            ->where('id', $postId)
            ->firstOrFail();

        if ($post->media) {
            $media = Post::find($postId)->getFirstMedia('posts');
        }

        if ($post->translations->count() >= 1) {

            if ($post->category->translations) {
                $category =  $post->category->translations->where('locale', App::getLocale())->first()->name;
            }

            $update = Carbon::createFromTimeStamp(strtotime($post->translations->first()->updated_at))->isoFormat('LL');

        } else {
            // TODO: Make error page with back route!
            dd('No translation available for this post!');
        }


        //TODO: add permission check
        //TODO: if 403, but has permission, redirect with message to switch profile
        //TODO: replace 403 with custom redirect page incl explanation
        return ($post != null ? view('posts.show', compact(['post','media','category','update'])) : abort(403));
    }

    
    /**
     * Show view by .../posts/{slug}. 
     * Post will be shown in user's App:locale() language if available, even is the slug is in another language.
     *
     * @param  mixed $slug
     * @return void
     */
    public function showBySlug($slug)
    {
        $postTranslation = PostTranslation::where('slug', $slug)->get()->first();
        $postId = $postTranslation->post_id;
        $locale = $postTranslation->locale;
        $post =
            Post::with([
            'postable' => function ($query) {
                $query->select(['id', 'name']);
            },
            'category'=> function ($query) {
                $query->with('translations');
            },
            'translations' => function ($query) {
                $query
                ->where('locale', App::getLocale());
                // ->whereDate('start', '<=', now())    //! include date queries and not (yet) published page!
                // ->where( function($query) {
                //     $query->whereDate('stop', '>', now())->orWhereNull('stop');
                // })
            },
            ])
            ->where('id', $postId)
            ->firstOrFail();
            // dd($postId);

        if ($post->media) {
            $media = Post::find($postId)->getFirstMedia('posts');
        }

        if ($post->translations->count() >= 1) {

            if ($post->category->translations) {
                $category =  $post->category->translations->where('locale', App::getLocale())->first()->name;
            }

            $update = Carbon::createFromTimeStamp(strtotime($post->translations->first()->updated_at))->isoFormat('LL');

        } else {
            // TODO: Make error page with back route!
            dd('No translation available for this post!');
        }


        //TODO: add permission check
        //TODO: if 403, but has permission, redirect with message to switch profile
        //TODO: replace 403 with custom redirect page incl explanation
        return ($post != null ? view('posts.show', compact(['post','media','category','update'])) : abort(403));

    }



    public function admin()
    {
        return view(
            'posts.index',
        );
    }
}
