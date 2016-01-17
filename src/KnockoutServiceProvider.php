<?php

namespace Zawntech\Laravel\KnockoutViews;

use Illuminate\Support\ServiceProvider;

class KnockoutServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Knockout::class, function ($app) {
            return new Knockout;
        });
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'knockout');
    }
}