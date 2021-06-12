<?php

namespace Database\Seeders;

use App\Models\TipoProposta;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoPropostaSeeder extends Seeder
{
    private $listaTipoProposta = ['PF', 'PJ'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            foreach ($this->listaTipoProposta as $tipoProposta) {
                $r = TipoProposta::create([
                    'descricao' => $tipoProposta
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
