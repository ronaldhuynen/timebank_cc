<?php

use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\RegisterStep2Controller;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Broadcast test
Route::get('/test/broadcast', function () {
    // manually authorize user 2
    $user = User::find(2);
    $toUserId = 2;
    Auth::login($user);
    return view('test.broadcast', compact(['user' , 'toUserId']));
});
// IpLocation test
Route::get('/test/ip-location', [UserController::class, 'index']);
// Clear cache test
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


Route::get('/delete-duplicate-tags', function () {
   
    $tags = Tag::with('locale')->get();
    $tagsUnique = $tags->unique(function ($item) {
        return $item['name'].$item['locale']['locale'];
    });
    $tagsDupl = $tags->diff($tagsUnique)->toArray();
    if ($tagsDupl == []){
        echo "No duplicate tags found.";
    } else {
        echo "These duplicate tags have been deleted: <br />";
        echo "<br>";
        foreach ($tagsDupl as $key => $item) {
            $del = Tag::find($item['tag_id'])->delete();
            if ($del) {
                echo $item['locale']['locale'] . ": ";
                echo $item['name'] . "<br />";
                Log::notice('duplicate tag deleted: '. $item['locale']['locale'] . ' '. $item['name']);
            }
        }
        echo "See log for more details";
    }
});

        
    // /**
    //  * Delete all tags with duplicate name in a single locale.
    //  * Locale records will also be removed.
    //  *
    //  * @return void
    //  */
    // public function deleteDuplicates()
    // {
    //     $tags = Tag::with('locale')->get();
    //     $tagsUnique = $tags->unique(function ($item) {
    //         return $item['name'].$item['locale']['locale'];
    //     });
    //     $tagsDupl = $tags->diff($tagsUnique)->pluck('name')->toArray();
    //     return  Tag::find($tagsDupl)->delete();
    // }






Route::group(['prefix' => (new LaravelLocalization())->setLocale()], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('/', function () {
        return view('welcome');
    });


    // Route::post('upload', [UploadController::class, 'store']);

    //----- Protected auth verified routes -----//
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session')
        ,'verified'
    ])->group(function () {
        Route::group(['middleware' => ['registration-complete']], function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');

            Route::get('/transfer', 'App\Http\Controllers\TransactionController@transfer')->name('transfer');
            Route::post('/transfer', 'App\Http\Controllers\TransactionController@saveTransfer')->name('saveTransfer');

            Route::get('/transactions', 'App\Http\Controllers\TransactionController@transactions')->name('transactions');

            Route::get('/statement/{transactionId}', 'App\Http\Controllers\TransactionController@statement')
                ->where(['transactionId' => '[0-9]+'])     // Add constraint: only numbers allowed
                ->name('transaction.show');


            Route::get('/posts/manage', 'App\Http\Controllers\PostController@admin')->name('posts.manage');

            Route::get('/posts/{postId}', 'App\Http\Controllers\PostController@showById')
                ->where(['postId' => '[0-9]+'])     // Add constraint: only numbers allowed
                ->name('posts.show_by_id')
                ->missing(function () {return view('posts.not_found');});

            Route::get('/posts/{slug}', 'App\Http\Controllers\PostController@showBySlug')
                ->name('posts.show_by_slug');




            Route::get('/user/personal-profile', 'App\Http\Controllers\ProfileUserController@show')->name('profile-user.show');

            Route::get('/org/organization-profile', 'App\Http\Controllers\ProfileOrgController@show')->name('profile-organization.show');

            Route::get('/users-overview', 'App\Http\Controllers\UserController@index')->name('users-overview');
        });


        // // Route when full registration has NOT yet been completed.
        // // See RegistrationComplete.php
        // //Registration steps, protected with auth middleware
        // Route::get('/register-step2', [\App\Http\Controllers\RegisterStep2Controller::class, 'create'])
        //     ->name('register-step2.create');
        // Route::post('/register-step2', [\App\Http\Controllers\RegisterStep2Controller::class, 'store'])
        //     ->name('register-step2.post');
    });

});
