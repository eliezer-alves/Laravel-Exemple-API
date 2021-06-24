<?php

namespace App\Providers;

use App\Services\Contracts\{
    ApiSicredServiceInterface,
    CcbServiceInterface,
    GacConsultaServiceInterface
};
use App\Services\{
    ApiSicredService,
    CCB\CcbService,
    GacConsultas\GacConsultaService,
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

        $this->app->bind(
            CcbServiceInterface::class,
            CcbPfService::class
        );

        $this->app->bind(
            CcbServiceInterface::class,
            CcbService::class
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
