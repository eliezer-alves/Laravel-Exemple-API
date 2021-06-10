<?php

namespace App\Services\GacConsultas;

use App\Services\Contracts\GacConsultaServiceInterface;
use App\Services\GacConsultas\AbstractGacConsultaService;

/**
 * Service Layer - Class responsible for managing InfoMais queries
 *
 * @author Eliezer Alves
 * @since 10/06/2021
 *
 */
class ScrService extends AbstractGacConsultaService implements GacConsultaServiceInterface
{
    private $codigosPrejuizo;
    private $codigosCreditoDisponivel;
    private $codigosTotalAVencer;
    private $codigosTotalVencido;
    private $codigosVencerAte30Dias;
    private $codigosVencerAcima30Ate60Dias;
    private $codigosVencerAcima60Dias;
    private $codigosVencidoAte30Dias;
    private $codigosVencidoAcima30Ate60Dias;
    private $codigosVencidoAcima60Dias;

    public function __construct($cpf)
    {
        parent::__construct($cpf);
        $this->codigosCreditoDisponivel = ['v20', 'v40'];
        $this->codigosTotalAVencer = ['v110','v120','v130','v140','v150','v160','v165','v170','v175','v180','v190','v199'];
        $this->codigosTotalVencido = ['v205', 'v210','v220','v230','v240','v245','v250','v255','v260','v270','v280','v290'];
        $this->codigosPrejuizo = ['v310','v320', '330'];
        $this->codigosVencerAte30Dias = ['v110'];
        $this->codigosVencerAcima30Ate60Dias = ['V120'];
        $this->codigosVencerAcima60Dias = ['v130','v140','v150','v160','v165','v170','v175','v180','v190','v199'];
        $this->codigosVencidoAte30Dias = ['v205', 'v210'];
        $this->codigosVencidoAcima30Ate60Dias = ['v220'];
        $this->codigosVencidoAcima60Dias = ['v230','v240','v245','v250','v255','v260','v270','v280','v290'];
    }

    public function consultar()
    {
        return $this->formatarConsulta($this->request('/scr'));
    }

    public function consultarById()
    {
        return $this->formatarConsulta($this->requestById('/scr'));
    }

    private function formatarConsulta($dadosConsulta)
    {
        $operacoes = collect($dadosConsulta->resumo_operacoes);
        $operacoesModalidades = $operacoes->groupBy('modalidade');
        foreach ($operacoesModalidades as $key => $modalidade) {
            $operacoesModalidades[$key] = [
                'credito_disponivel' => $modalidade->whereIn('codigo_vencimento', $this->codigosCreditoDisponivel)->sum('valor_vencimento'),
                'total_credito' => $modalidade->sum('valor_vencimento'),
                'descricao_modalidade' => $modalidade->first()->descricao_modalidade,
                'modalidade' => $key,
                'prejuizo' => $modalidade->whereIn('codigo_vencimento', $this->codigosPrejuizo)->sum('valor_vencimento'),
                'total_vencer' => $modalidade->whereIn('codigo_vencimento', $this->codigosTotalAVencer)->sum('valor_vencimento'),
                'total_vencido' => $modalidade->whereIn('codigo_vencimento', $this->codigosTotalVencido)->sum('valor_vencimento'),
                'total_vencer_trinta_dias' => $modalidade->whereIn('codigo_vencimento', $this->codigosVencerAte30Dias)->sum('valor_vencimento'),
                'total_vencer_sessenta_dias' => $modalidade->whereIn('codigo_vencimento', $this->codigosVencerAcima30Ate60Dias)->sum('valor_vencimento'),
                'total_vencer_acima_sessenta_dias' => $modalidade->whereIn('codigo_vencimento', $this->codigosVencerAcima60Dias)->sum('valor_vencimento'),
                'vencido_trinta_dias' => $modalidade->whereIn('codigo_vencimento', $this->codigosVencidoAte30Dias)->sum('valor_vencimento'),
                'vencido_sessenta_dias' => $modalidade->whereIn('codigo_vencimento', $this->codigosVencidoAcima30Ate60Dias)->sum('valor_vencimento'),
                'vencido_acima_sessenta_dias ' => $modalidade->whereIn('codigo_vencimento', $this->codigosVencidoAcima60Dias)->sum('valor_vencimento'),
            ];
        }

        return $operacoesModalidades->all();
    }

}
