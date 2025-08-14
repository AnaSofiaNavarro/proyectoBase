<?php

namespace App\Providers;

// use Illuminate\Contracts\Pagination\Paginator;
use server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;

class AppServiceProvider extends ServiceProvider
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

        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        // Schema::defaultStringLength(191);
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
