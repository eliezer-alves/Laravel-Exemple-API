<?php

namespace Database\Seeders;

use App\Models\ModeloSicred;
use App\Models\UrlSicred;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeloSicredSeeder extends Seeder
{
    private $modelos = [
        [
            'modelo' => 'capital-de-giro-acima',
            'empresa' => '01',
            'agencia' => '0001',
            'loja' => '0001',
            'lojista' => '000002',
            'cosif' => '4300',
            'produto' => '000080',
            'plano' => '0080',
            'taxa' => 4.99
        ],
        [
            'modelo' => 'capital-de-giro-abaixo',
            'empresa' => '01',
            'agencia' => '0001',
            'loja' => '0001',
            'lojista' => '000002',
            'cosif' => '4300',
            'produto' => '000079',
            'plano' => '0079',
            'taxa' => 4.99
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
            foreach ($this->modelos as $modelo) {
                $modeloSicred = ModeloSicred::create($modelo);
                $modeloSicred->urls()->attach(UrlSicred::all());
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
