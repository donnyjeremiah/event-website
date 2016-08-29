<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('EventService', function()
        {
            return new \App\Services\EventService;
        });

        /*
        \App::bind('Illuminate\Routing\ResourceRegistrar', function () {
            return \App::make('App\Providers\ResourceNoPrefixRegistrar');
        });
        */
        $this->app->bind(
            'Illuminate\Routing\ResourceRegistrar',
            'App\Providers\ResourceNoPrefixRegistrar'
        );
    }
}
