<?php

namespace App\Providers;

use App\Services\Contracts\{
    ApiSicredServiceInterface
};
use App\Services\{
    ApiSicredService
};

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
            ApiSicredServiceInterface::class,
            ApiSicredService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
