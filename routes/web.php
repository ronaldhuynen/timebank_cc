<?php

use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\RegisterStep2Controller;
use App\Http\Controllers\TestController;
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
Route::get('/test/ip-location', [TestController::class, 'index']);
// Clear cache test
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

//TODO: Use translated routes, see https://github.com/mcamara/laravel-localization


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
                
            
            Route::get('/user/{userId}', 'App\Http\Controllers\UserController@show')
                ->where(['userId' => '[0-9]+'])     // Add constraint: only numbers allowed
                ->name('user.show')
                ->missing(function () {return view('user.not_found');});


            Route::get('/org/{orgId}', 'App\Http\Controllers\OrgController@show')
                ->where(['orgId' => '[0-9]+'])     // Add constraint: only numbers allowed
                ->name('org.show')
                ->missing(function () {return view('org.not_found');});

                
            Route::get('/user/edit', 'App\Http\Controllers\UserController@edit')
                ->name('user.edit');


            Route::get('/org/edit', 'App\Http\Controllers\OrgController@edit')
                ->name('org.edit');


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
