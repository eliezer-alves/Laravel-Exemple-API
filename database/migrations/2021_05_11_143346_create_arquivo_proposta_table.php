<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArquivoPropostaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_arquivo_prosta', function (Blueprint $table) {
            $table->id('id_arquivo_proposta');
            $table->string('link', 254);
            $table->foreignId('id_proposta')
                ->nullable()
                ->unsigned()
                ->constrained('cad_proposta', 'id_proposta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrato_social');
    }
}
