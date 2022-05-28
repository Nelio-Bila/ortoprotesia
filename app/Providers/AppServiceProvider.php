<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;

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
    public function boot(UrlGenerator $url)
    {
        Schema::defaultStringLength(191);

        if ($this->app->isLocal()) {
            //if local register your services you require for development

        } else {
            //else register your services you require for production
            $url->forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }

        // if (env('APP_ENV') === 'production') {
        //     //register your services you require for production
        //     $this->app['request']->server->set('HTTPS', true);
        // }

        // if ($this->app->environment('production')) {
        //     $this->app['request']->server->set('HTTPS', 'on');
        // }

        // if (env('APP_ENV') === 'production') {
        // if (App::environment('production')) {
        // $this->app['request']->server->set('HTTPS', 'on'); // this line

        // URL::forceScheme('https');
        // $url->forceScheme('https');
        // }
    }
}