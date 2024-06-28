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
            info('Auth attempt with identifier: ' . $request->auth);

            if ($user) {
                if (!empty($user->cyclos_salt)) {            
                    // If cyclos_salt is not empty, use cyclos auth hash
                    info('Auth attempt using original Cyclos password');                        
                    $concatenated = $user->cyclos_salt . $request->password;
                    $hashedInputPassword = hash("sha256", $concatenated);

                    if (strtolower($hashedInputPassword) === strtolower($user->password)) {
                        info('Auth success: Password is verified');
                        // Rehash to Laravel hash and remove salt
                        $user->password = Hash::make($request->password);
                        $user->cyclos_salt = null;
                        $user->save();
                        info('Auth success: Cyclos password has been rehashed for next login');
                        // Save user's login time and ip
                        $user->update([
                            'last_login_at' => Carbon::now()->toDateTimeString(),
                            'last_login_ip' => $request->getClientIp()
                        ]);
                        return $user;
                    }
                }
                // Fallback to Laravel's default hash check if cyclos_salt is empty
                if (Hash::check($request->password, $user->password)) {
                    info('Auth success: Password is verified');
                    return $user;
                } else {
                    info('Auth failed: Input password does not match stored password');
                }
            }
            info('Auth failed: Not identified');
        });


    }
}
