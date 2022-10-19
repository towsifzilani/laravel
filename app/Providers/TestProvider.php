<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TestProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TestServiceInterface::class, TestService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
