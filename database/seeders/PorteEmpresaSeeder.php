<?php

namespace Database\Seeders;

use App\Models\PorteEmpresa;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PorteEmpresaSeeder extends Seeder
{
    private $listaPortesEmpresa = ['MICROEMPREENDEDOR IINDIVIDUAL (MEI)', 'MICROEMPRESA (ME)', 'EMPRESA DE PEQUENO PORTE (EPP)', 'EMPRESA DE MEDIO PORTE', 'GRANDE EMPRESA'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            foreach ($this->listaPortesEmpresa as $porteEmpresa) {
                $r = PorteEmpresa::create([
                    'descricao' => $porteEmpresa
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rolback();
        }
    }
}
