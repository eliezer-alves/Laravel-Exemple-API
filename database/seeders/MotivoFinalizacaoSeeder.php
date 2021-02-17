<?php

namespace Database\Seeders;

use App\Models\MotivoFinalizacao;

use Illuminate\Database\Seeder;

class MotivoFinalizacaoSeeder extends Seeder
{
    private $listaMotivoFinalizacao = ['NAO CONCORDO COM AS TAXAS DE JUROS', 'NAO PRECISO DE EMPRESTIMO NO MOMENTO', 'NAO TENHO INTERESSE', 'VOU PENSAR NA PROPOSTA', 'OUTROS'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->listaMotivoFinalizacao as $motivo) {
            $r = MotivoFinalizacao::create([
                'descricao' => $motivo
            ]);
        }
    }
}
