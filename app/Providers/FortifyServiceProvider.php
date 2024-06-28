<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);


        Fortify::verifyEmailView(fn () => view('auth.verify-email'));


        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Rehash Cyclos salted sha256 passwords on first login       
        Fortify::authenticateUsing(function (Request $request) {
            // Attempt to find the user by email or name.
            $user = User::where('email', $request->auth)
                        ->orWhere('name', $request->auth)
                        ->first();

            info('Attempting to authenticate user with identifier: ' . $request->auth);

            if ($user && Hash::check($request->password, $user->password)) {
                // Check if the password needs rehashing (i.e., it's not using bcrypt).
                if (!empty($user->cyclos_salt)) {
                    info('Password needs rehashing');
                    // Rehash the password.
                    $user->password = Hash::make($request->password);
                    $user->cyclos_salt = null; // Assuming this indicates the password has been migrated.
                    $user->save();
                }
                
                //Save user's last login time and ip
                  $user->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                        ]);
                return $user;
            }
        });


    }
}
