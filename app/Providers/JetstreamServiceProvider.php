<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Http\Livewire\ProfileUser\UpdateProfilePersonalForm;
use App\Http\Livewire\ProfileUser\UpdateProfilePhoneForm;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use Livewire\Livewire;


class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerComponent('toaster');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
        Livewire::component('profile-user.update-profile-personal-form', UpdateProfilePersonalForm::class);
        Livewire::component('profile-user.update-profile-phone-form', UpdateProfilePhoneForm::class);

    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }

    protected function registerComponent(string $component)
    {
        \Illuminate\Support\Facades\Blade::component('jetstream::components.'.$component, 'jet-'.$component);
    }
}
