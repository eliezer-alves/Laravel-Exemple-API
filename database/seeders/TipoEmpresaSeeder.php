<?php

namespace Database\Seeders;

use App\Models\TipoEmpresa;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEmpresaSeeder extends Seeder
{
    private $listaTipoEmpresa = ['PJ SOCIEDADE', 'PJ INDIVIDUAL'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            foreach ($this->listaTipoEmpresa as $tipoEmpresa) {
                $r = TipoEmpresa::create([
                    'descricao' => $tipoEmpresa
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
