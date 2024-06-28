<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('api', function ($app) {
            return new Client([
                'base_uri' => config('services.api.base_url'),
                'timeout'  => 10.0,
            ]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
