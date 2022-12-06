<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// // Laracat Broadcast lesson:
// Route::get('/test/broadcast', function () {
//     $user = User::find(2);
//     return view('test.broadcast', ['user' => $user]);
// });


Route::get('/test/broadcast', function () {
    // manually authorize user 2
    $user = User::find(2);
    $toUserId = 2;
    Auth::login($user);
    return view('test.broadcast', compact(['user' , 'toUserId']));
});



Route::get('/', function () {
    return view('welcome');
});


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});



//----- Protected auth routes -----//
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/transfer', 'App\Http\Controllers\TransactionController@transfer')->name('transfer');

    Route::post('/transfer', 'App\Http\Controllers\TransactionController@saveTransfer')->name('saveTransfer');

    Route::get('/transactions', 'App\Http\Controllers\TransactionController@transactions')->name('transactions');

    //TODO: Route fixen!
    // Route::get('/transaction/{transactionId}/{accountId}', function ($transactionId, $acountId {return 'Transaction '.$id, 'Account '.$id})'App\Http\Controllers\TransactionController@singleTransaction')->name('transaction');

    Route::get('/users-overview', 'App\Http\Controllers\UserController@index')->name('users-overview');

});

