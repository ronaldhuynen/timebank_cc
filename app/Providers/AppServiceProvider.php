<?php

namespace App\Providers;

use App\View\Components\GuestLayout;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Matchish\ScoutElasticSearch\ElasticSearch\EloquentHitsIteratorAggregate',
            'app\Overrides\Matchish\ScoutElasticSearch\ElasticSearch\EloquentHitsIteratorAggregate'
        );

    }

    /**

     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fix 'Specified key was too long error' when storing emoji's as string in DB.
        Schema::defaultStringLength(191);


        if (!Collection::hasMacro('paginate')) {

            Collection::macro(
                'paginate',
                function ($perPage = 15, $page = null, $options = []) {
                    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                    return (new LengthAwarePaginator(
                        $this->forPage($page, $perPage),
                        $this->count(),
                        $perPage,
                        $page,
                        $options
                    ))
                        ->withPath('');
                }
            );
        }

        // Register Guest Layout
        Blade::component('guest-layout', GuestLayout::class);

    }
}
