<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
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

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });


        // Custom Fortify auth method to auth migrated users from cyclos with original cyclos hash (with salt)
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (!empty($user->cyclos_salt)) {
                    // If cyclos_salt is not empty, use cyclos auth hash
                    info('Auth attempt on original cyclos password using: ' . $request->email . '');
                    $saltedHash = $user->cyclos_salt . $request->password;
                    $hashedInputPassword = hash("sha256", $saltedHash);
                    if (strtolower($hashedInputPassword) === strtolower($user->password)) {
                        // Rehash to Laravel hash and remove salt
                        $user->password = Hash::make($request->password);
                        $user->cyclos_salt = null;
                        $user->save();
                        info('Auth success, cyclos password is rehashed for next login');
                        return $user;
                    }
                }

                // Fallback to Laravel's default hash check if cyclos_salt is empty or SHA256 check fails
                if (Hash::check($request->password, $user->password)) {
                    return $user;
                }
            }
        });
    }
}
