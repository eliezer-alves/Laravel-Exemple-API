<?php

namespace App\Services;

use App\Repositories\Contracts\ConfiguracaoRepositoryInterface;

/**
 * Service Layer - Class responsible for connecting to the GAC Web Service
 *
 * @author Eliezer Alves
 * @since 03/2021
 *
 */
class GacWebService
{
    private $configuracao;
    private $dbServer;
    private $token;
    private $useSSL;
    private $certSSL;
    private $baseUrl;
    private $proc;
    private $result;
    private $errors;
    private $statusCode;

    public function __construct(ConfiguracaoRepositoryInterface $configuracao)
    {
        $this->configuracao = $configuracao->all();
        $this->proc = 'WS_P_Agil';
        // $this->dbServer = '192.168.0.16';
    }

    public function hydrator_bolt()
    {
        foreach ($this->configuracao as $c) {
            switch ($c->key) {
                case 'dbserver':
                    $this->dbServer = $c->value;
                    break;
                case 'webservice_bolt_token':
                    $this->token = $c->value;
                    break;
                case 'webservice_bolt_use_ssl':
                    $this->useSSL = $c->value;
                    break;
                case 'webservice_bolt_cert_ssl':
                    $this->certSSL = $c->value;
                    break;
                case 'webservice_bolt_base_url':
                    $this->baseUrl = $c->value;
                    break;
            }
        }
    }

    public function hydrator_bcard()
    {
        foreach ($this->configuracao as $c) {
            switch ($c->key) {
                case 'dbserver':
                    $this->dbServer = $c->value;
                    break;
                case 'webservice_token':
                    $this->token = $c->value;
                    break;
                case 'webservice_use_ssl':
                    $this->useSSL = $c->value;
                    break;
                case 'webservice_cert_ssl':
                    $this->certSSL = $c->value;
                    break;
                case 'webservice_base_url':
                    $this->baseUrl = $c->value;
                    break;
            }
        }
    }

    private function ExecutaCurlJson($urlDoServico, $tipoRequest, $post = null, $headerExtras = array(), $baseUrl = null, $token = null, $webservice = 'ws')
    {
        $this->baseUrl = $baseUrl ?: $this->baseUrl;
        $this->token = $token ?: $this->token;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl . $urlDoServico);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $tipoRequest);

        if ($post !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $dadosHeader = array(
            'Content-Type: application/json',
            'Token: ' . $this->token,
            'dbserver: ' . $this->dbServer
        );

        foreach ($headerExtras as $key => $value) {
            $dadosHeader[] = $key . ': ' . $value;
        }
        if ($tipoRequest == 'GET') {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $dadosHeader);
        } else {
            $dadosHeader[] = 'Content-Length: ' . strlen(json_encode($post));
            curl_setopt($curl, CURLOPT_HTTPHEADER, $dadosHeader);
        }

        if ($this->useSSL) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_CAINFO, $this->certSSL);
        }

        $this->result = curl_exec($curl);
        $this->errors = curl_error($curl);
        $this->statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if (!empty($this->errors)) {
            error_log('Erro ao consumir webservice: ' . $this->errors);
        }

        return $this->result;
    }

    public function request($post = NULL, $select = '1', $prefixo = 'P_', $webservice = 'ws')
    {
        $headers = [
            'Select' => $select,
            'Prefixo' => $prefixo,
            'Proc' => $this->proc
        ];
        return json_decode($this->ExecutaCurlJson('requisicao/login', 'POST', $post, $headers, null, null, $webservice));
    }
}
