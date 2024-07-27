<?php

use App\Http\Controllers\LangJsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestController;
use App\Models\User;
use App\View\Components\GuestLayout;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Jetstream;
use Mcamara\LaravelLocalization\LaravelLocalization;
use RTippin\MessengerUi\Http\Controllers\ViewPortalController;

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

// DEBUG ROUTES
// Check if the application environment is secure for debugging
if (App::environment(['local', 'development', ' test' ])) {

    // Broadcast test with manual authorization
    Route::get('/test/broadcast', function () {
        // manually authorize user 2
        $user = User::find(2);
        $toUserId = 2;
        Auth::login($user);
        return view('test.broadcast', compact(['user' , 'toUserId']));
    });


    // IpLocation test
    Route::get('/test/ip-location', [TestController::class, 'viewIpLocation'])->name('ip-location');


    // Debug sandbox 1
    Route::get('/test/debug-1', [TestController::class, 'viewDebug1'])->name('debug-1');

    
    // Debug sandbox 2
    Route::get('/test/debug-2', [TestController::class, 'viewDebug2'])->name('debug-2');

    
    // Clear cache
    Route::get('/test/clear-cache', [TestController::class, 'clearCache'])->name('clear-cache');
   
    // Optimize clear
    Route::get('/test/opt-clear', [TestController::class, 'optimizeClear'])->name('optimize-clear');

}




//! TODO translate js packages
// Dynamically create routes for all available locales for the lang.js file
// This is used to dynamically load the correct language file in the frontend (like the Chat Messenger)
Route::get('/js/lang.js', [LangJsController::class, 'js'])->name('lang.js');


//TODO: Use translated routes, see https://github.com/mcamara/laravel-localization

Route::group(['prefix' => (new LaravelLocalization())->setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function () {
        /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

        Route::get('/', function () {
            return view('welcome');
        })->name('welcome');

        
        Route::get('/goodbye', function () {
            return view('goodbye-deleted-user');
        })->name('goodbye-deleted-user');


        
        

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

                Route::get('/nl/dashboard', function () {
                    return view('dashboard');
                })->name('nl.dashboard');

                Route::get('/en/dashboard', function () {
                    return view('dashboard');
                })->name('en.dashboard');

                Route::get('/fr/dashboard', function () {
                    return view('dashboard');
                })->name('fr.dashboard');

                Route::get('/es/dashboard', function () {
                    return view('dashboard');
                })->name('es.dashboard');

                //TODO: change 'transfer' route to 'pay' route? Easier for users to remember
                Route::get('/transfer', 'App\Http\Controllers\TransactionController@transfer')->name('transfer');
                Route::post('/transfer', 'App\Http\Controllers\TransactionController@saveTransfer')->name('saveTransfer');

                Route::get('/pay/{name}', 'App\Http\Controllers\TransactionController@payToName')
                                    ->name('pay.to.name')
                                    ->missing(function () {return view('transfer.profile_not_found');});


                Route::get('/transactions', 'App\Http\Controllers\TransactionController@transactions')->name('transactions');

                Route::get('/statement/{transactionId}', 'App\Http\Controllers\TransactionController@statement')
                    ->where(['transactionId' => '[0-9]+'])     // Add constraint: only numbers allowed
                    ->name('transaction.show');


                Route::get('/posts/manage', 'App\Http\Controllers\PostController@admin')->name('posts.manage');

                Route::get('/post/{postId}', 'App\Http\Controllers\PostController@showById')
                    ->where(['postId' => '[0-9]+'])     // Add constraint: only numbers allowed
                    ->name('post.show_by_id')
                    ->missing(function () {return view('post.not_found');});

                Route::get('/post/{slug}', 'App\Http\Controllers\PostController@showBySlug')
                    ->name('post.show_by_slug');


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


                // Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');


                Route::get('/users-overview', 'App\Http\Controllers\UserController@index')->name('users-overview');



                // Route::get('/send-friend-request', SendFriendRequest::class);


                Route::get('/user/{userId}', 'App\Http\Controllers\UserController@show')
                                    ->where(['userId' => '[0-9]+'])     // Add constraint: only numbers allowed
                                    ->name('user.show')
                                    ->missing(function () {return view('user.not_found');});


                Route::get('/search', [SearchController::class, 'show'])->name('search.show');

                // Messenger invitation link to join a group thread
                Route::get('/messenger/join/{invite}', [ViewPortalController::class, 'showJoinWithInvite'])
                    ->middleware('auth');


                // Jetstream routes (copied from vendor/laravel/jetstream/routes/livewire.php, to overrule, to include in Laravel-localization class)
                Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
                    if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
                        Route::get('/terms-of-service', [TermsOfServiceController::class, 'show'])->name('terms.show');
                        Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');
                    }

                    $authMiddleware = config('jetstream.guard')
                            ? 'auth:'.config('jetstream.guard')
                            : 'auth';

                    $authSessionMiddleware = config('jetstream.auth_session', false)
                            ? config('jetstream.auth_session')
                            : null;

                    Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware]))], function () {
                        // User & Profile...
                        Route::get('/user/settings', [UserProfileController::class, 'show'])->name('profile.show');

                        Route::group(['middleware' => 'verified'], function () {
                            // API...
                            if (Jetstream::hasApiFeatures()) {
                                Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
                            }

                            // Teams...
                            if (Jetstream::hasTeamFeatures()) {
                                Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
                                Route::get('/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                                Route::put('/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');

                                Route::get('/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
                                            ->middleware(['signed'])
                                            ->name('team-invitations.accept');
                            }
                        });
                    });
                });




            });

            
            // This route should always be the last route in the file!
            // It will catch all routes that are not defined above as a {name} route.
            Route::get('/{name}', 'App\Http\Controllers\UserController@showByName')
                    ->name('show.by.name')
                    ->missing(function () {return view('user.not_found');});


            // // Route when full registration has NOT yet been completed.
            // // See RegistrationComplete.php
            // //Registration steps, protected with auth middleware
            // Route::get('/register-step2', [\App\Http\Controllers\RegisterStep2Controller::class, 'create'])
            //     ->name('register-step2.create');
            // Route::post('/register-step2', [\App\Http\Controllers\RegisterStep2Controller::class, 'store'])
            //     ->name('register-step2.post');
        });

    });
