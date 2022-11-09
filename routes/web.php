<?php

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

Route::get('/', function () {
    return view('welcome');
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

    Route::get('/users-overview', function () {
        return view('admin.users-overview');
    })->name('users-overview');

});
