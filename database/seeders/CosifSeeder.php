<?php

namespace Database\Seeders;

use App\Models\Cosif;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CosifSeeder extends Seeder
{
    private $listaCosifs = [
        [
            'id' => 4100,
            'descricao' => 'RURAL'
        ],
        [
            'id' => 4200,
            'descricao' => 'INDUSTRIA'
        ],
        [
            'id' => 4300,
            'descricao' => 'COMERCIO'
        ],
        [
            'id' => 4500,
            'descricao' => 'SERVICOS'
        ],
        [
            'id' => 4600,
            'descricao' => 'PESSOAS FISICAS'
        ],
        [
            'id' => 4700,
            'descricao' => 'HABITACAO'
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
            foreach ($this->listaCosifs as $cosif) {
                Cosif::create($cosif);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
