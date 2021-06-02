<?php

namespace App\Repositories\Contracts;

interface PropostaRepositoryInterface extends AbstractRepositoryInterface
{
    public function findByNumero(int $numeroProposta);

    /**
     * Repository Layer - Method responsible for changing the proposal review status
     *
     * @param  int  $idStatusAnaliseProposta
     * @param  int  $idProposta
     * @return App\Repositories\AnalisePropostaRepository
     */
    public function alterarStatusAnalise(int $idStatusAnaliseProposta, int $idProposta);
}
