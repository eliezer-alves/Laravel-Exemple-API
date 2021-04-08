<?php

namespace App\Services;

use App\Repositories\Contracts\ConfiguracaoRepositoryInterface;

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
    private $urlDoServico;

    public function __construct(ConfiguracaoRepositoryInterface $configuracao)
    {
        $this->configuracao = $configuracao->all();
        $this->proc = 'WS_P_Agil';
    }

    public function hydrator_bolt()
    {
        $this->urlDoServico = 'requisicao/login';
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
        $this->urlDoServico = 'requisicao';
        foreach ($this->configuracao as $c) {
            switch ($c->key) {
                case 'dbserver':
                    $this->dbServer = "192.168.0.31";
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
        // dd($this->dbServer, $this->token, $this->useSSL, $this->baseUrl);
    }

    public function setProc($proc)
    {
        $this->proc = $proc;
    }

    private function
    ExecutaCurlJson2($tipoRequest, $body = null, $headerExtras = array())
    {
    }

    private function ExecutaCurlJson($tipoRequest, $body = null, $headerExtras = array())
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl . $this->urlDoServico);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $tipoRequest);

        if ($body !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
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

        curl_setopt($curl, CURLOPT_HTTPHEADER, $dadosHeader);

        if ($tipoRequest != 'GET') {
            $dadosHeader[] = 'Content-Length: ' . strlen(json_encode($body));
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

    public function request($body = NULL, $select = '1', $prefixo = 'P_')
    {
        $headers = [
            'Select' => $select,
            'Prefixo' => $prefixo,
            'Proc' => $this->proc
        ];
        return json_decode($this->ExecutaCurlJson('POST', $body, $headers));
    }
}
