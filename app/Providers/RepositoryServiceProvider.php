<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    AbstractRepositoryInterface,
    AtividadeComercialRepositoryInterface,
    CosifRepositoryInterface,
    ClienteRepositoryInterface,
    PorteEmpresaRepositoryInterface,
    TipoEmpresaRepositoryInterface,
    UserRepositoryInterface,
};
use App\Repositories\Eloquent\{
    AbstractRepository,
    AtividadeComercialRepository,
    ClienteRepository,
    CosifRepository,
    PorteEmpresaRepository,
    TipoEmpresaRepository,
    UserRepository,
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any Repository Patters.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            AbstractRepositoryInterface::class,
            AbstractRepository::class
        );

        $this->app->bind(
            AtividadeComercialRepositoryInterface::class,
            AtividadeComercialRepository::class
        );

        $this->app->bind(
            ClienteRepositoryInterface::class,
            ClienteRepository::class
        );

        $this->app->bind(
            CosifRepositoryInterface::class,
            CosifRepository::class
        );

        $this->app->bind(
            PorteEmpresaRepositoryInterface::class,
            PorteEmpresaRepository::class
        );

        $this->app->bind(
            TipoEmpresaRepositoryInterface::class,
            TipoEmpresaRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
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
