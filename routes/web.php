<?php

use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\RegisterStep2Controller;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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
// CKeditor in Livewire test
Route::get(uri: '/demo', action: \App\Http\Livewire\Demo::class);



Route::group(['prefix' => (new LaravelLocalization())->setLocale()], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('/', function () {
        return view('welcome');
    });

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


            Route::get('/posts', 'App\Http\Controllers\PostController@index')->name('posts.index');

            Route::get('/user/personal-profile', 'App\Http\Controllers\ProfileUserController@show')->name('profile-user.show');

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
