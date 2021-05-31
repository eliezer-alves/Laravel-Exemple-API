<?php

namespace App\Services;

use App\Repositories\Contracts\{
    AnalisePropostaRepositoryInterface,
    AnalisePessoaPropostaRepositoryInterface,
};

/**
 * Service Layer - Class responsible for managing the proposal analysis process
 *
 * @author Eliezer Alves
 * @since 31/05/2021
 *
 */
class AnalisePropostaService
{
    private $analisePropostaRepository;
    private $analisePessoaPropostaRepository;

    public function __construct(AnalisePropostaRepositoryInterface $analisePropostaRepository, AnalisePessoaPropostaRepositoryInterface $analisePessoaPropostaRepository)
    {
        $this->analisePropostaRepository = $analisePropostaRepository;
        $this->analisePessoaPropostaRepository = $analisePessoaPropostaRepository;
    }

    /**
     * Service Layer - Method responsible for completing the analysis of the proposal.
     *
     * @param  array  $attributes
     * @param  int  $idProposta
     * @return App\Repositories\Contracts\AnalisePropostaRepositoryInterface
     */
    public function concluirAnaliseProposta($attributes, $idProposta)
    {
        $attributes['id_proposta'] = $idProposta;
        $analise = $this->analisePropostaRepository->firstWhere('id_proposta', $idProposta) ?? $this->analisePropostaRepository->fill([]);
        $analise->fill($attributes);
        $analise->save();

        $attributes['cliente']['id_analise_proposta'] = $analise->getKey();
        $attributes['cliente']['id_proposta'] = $idProposta;

        $analiseClienteAssinatura = $this->analisePessoaPropostaRepository->findAnaliseAndPessoa($analise->getKey(), $attributes['cliente']['id_pessoa_assinatura']) ?? $this->analisePessoaPropostaRepository->fill([]);
        $analiseClienteAssinatura->fill($attributes['cliente']);
        $analiseClienteAssinatura->save();

        $attributes['representante']['id_analise_proposta'] = $analise->getKey();
        $attributes['representante']['id_proposta'] = $idProposta;

        $analiseRepresentanteAssinatura = $this->analisePessoaPropostaRepository->findAnaliseAndPessoa($analise->getKey(), $attributes['representante']['id_pessoa_assinatura']) ?? $this->analisePessoaPropostaRepository->fill([]);
        $analiseRepresentanteAssinatura->fill($attributes['representante']);
        $analiseRepresentanteAssinatura->save();

        foreach ($attributes['socios'] as $socio) {
            $socio['id_analise_proposta'] = $analise->getKey();
            $socio['id_proposta'] = $idProposta;
            $analiseSocioAssinatura = $this->analisePessoaPropostaRepository->findAnaliseAndPessoa($analise->getKey(), $socio['id_pessoa_assinatura']) ?? $this->analisePessoaPropostaRepository->fill([]);
            $analiseSocioAssinatura->fill($socio);
            $analiseSocioAssinatura->save();
        }

        return $attributes;
    }
}
