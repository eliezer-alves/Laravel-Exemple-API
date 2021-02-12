<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ClienteSeeder::class);
        // $this->call(StatusSolicitacaoSeeder::class);
        // $this->call(StatusDocumentoPropostaSeeder::class);
        // $this->call(MotivoFinalizacaoSeeder::class);
        // $this->call(SolicitacaoSeeder::class);
        // $this->call(PropostaSeeder::class);
        // $this->call(DocumentoPropostaSeeder::class);
    }
}
