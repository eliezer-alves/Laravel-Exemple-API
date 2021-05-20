<?php

namespace Database\Seeders;

use App\Models\PorteEmpresa;

use Illuminate\Database\Seeder;

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
        foreach ($this->listaPortesEmpresa as $porteEmpresa) {
        	$r = PorteEmpresa::create([
        		'descricao' => $porteEmpresa
        	]);
        }
    }
}
