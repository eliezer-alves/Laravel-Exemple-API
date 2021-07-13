<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    AbstractRepositoryInterface,
    AnalisePessoaPropostaRepositoryInterface,
    AnalisePropostaRepositoryInterface,
    AtividadeComercialRepositoryInterface,
    CosifRepositoryInterface,
    ClienteRepositoryInterface,
    ClientSicredRepositoryInterface,
    ConfiguracaoRepositoryInterface,
    DocumentoPropostaRepositoryInterface,
    LogAnalisePropostaRepositoryInterface,
    ModeloSicredRepositoryInterface,
    ObservacaoPropostaRepositoryInterface,
    PessoaAssinaturaRepositoryInterface,
    PorteEmpresaRepositoryInterface,
    PropostaRepositoryInterface,
    PropostaParcelaRepositoryInterface,
    TipoEmpresaRepositoryInterface,
    TipoLogradouroRepositoryInterface,
    UserRepositoryInterface,
    UrlSicredRepositoryInterface
};
use App\Repositories\Eloquent\{
    AbstractRepository,
    AnalisePessoaPropostaRepository,
    AnalisePropostaRepository,
    AtividadeComercialRepository,
    ClienteRepository,
    ClientSicredRepository,
    CosifRepository,
    ConfiguracaoRepository,
    DocumentoPropostaRepository,
    LogAnalisePropostaRepository,
    ModeloSicredRepository,
    ObservacaoPropostaRepository,
    PessoaAssinaturaRepository,
    PorteEmpresaRepository,
    PropostaRepository,
    PropostaParcelaRepository,
    TipoEmpresaRepository,
    TipoLogradouroRepository,
    UserRepository,
    UrlSicredRepository
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
            TipoLogradouroRepositoryInterface::class,
            TipoLogradouroRepository::class
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
