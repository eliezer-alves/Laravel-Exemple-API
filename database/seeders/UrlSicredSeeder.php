<?php

namespace Database\Seeders;

use App\Models\ModeloSicred;
use App\Models\UrlSicred;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrlSicredSeeder extends Seeder
{
    private $listaUrlSicred = [
        [
            'servico'=> 'base_url',
            'url' =>'https://sicred-api-hml.agil.com.br',
        ],
        [
            'servico' => 'athentication_url',
            'url' =>'/auth/connect/token',
        ],
        [
            'servico' => 'simulacao_url',
            'url' =>'/simulacao/api/simulacao',
        ],
        [
            'servico' => 'proposta_url',
            'url' =>'/propostas/api/proposta',
        ],
        [
            'servico' => 'proposta_v2_url',
            'url' =>'/propostas/api/v2/Proposta',
        ],
        [
            'servico' => 'contrato_url',
            'url' =>'/contratos/api/contrato',
        ],
        [
            'servico' => 'contrato_v2_url',
            'url' =>'/contratos/api/v2/contrato',
        ],
        [
            'servico' => 'dominios',
            'url' => '/dominios/api',
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            foreach($this->listaUrlSicred as $urlSicred)
            {
                UrlSicred::create($urlSicred);
            }
            foreach(UrlSicred::all() as $urlSicred){
                $modelos = ModeloSicred::all();
                $urlSicred->modelos()->attach($modelos);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rolback();
        }
    }
}
