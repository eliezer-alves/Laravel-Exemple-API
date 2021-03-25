<?php

namespace App\Providers;

use App\Entities\Contracts\{
    ClienteAtendimentoEntityInterface
};
use App\Entities\{
    ClienteAtendimentoEntity
};

use Illuminate\Support\ServiceProvider;

class EntityServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ClienteAtendimentoEntityInterface::class,
            ClienteAtendimentoEntity::class
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
