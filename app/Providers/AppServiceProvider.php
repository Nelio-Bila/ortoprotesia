<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
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
    }
}
