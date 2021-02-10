<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_solicitacao_proposta', function (Blueprint $table) {
            $table->id('id_solicitacao_proposta');
            $table->float('valor_solicitado');
            $table->integer('proposta');
            $table->integer('id_status_solicitacao')->constrained('cad_status_solicitacao');
            $table->integer('id_motivo_finalizacao')->constrained('cad_motivo_finalizacao_solicitacao');
            $table->string('observacao');
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
        Schema::dropIfExists('log_solicitacao_proposta');
    }
}
