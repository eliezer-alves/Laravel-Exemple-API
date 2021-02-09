<?php

namespace Database\Seeders;

use App\Models\DocumentoProposta;

use Illuminate\Database\Seeder;

class DocumentoPropostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$documento = DocumentoProposta::create([
    		'id_proposta' => 2,
	    	'id_usuario' => 0,
	    	'link' => '#',
	    	'observacao' => 'OBSERVACAO DOCUMENMTO',
	    	'id_status_documento' => 1
    	]);
    }
}
