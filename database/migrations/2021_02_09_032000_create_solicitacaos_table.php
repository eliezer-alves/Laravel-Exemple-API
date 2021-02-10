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
            $table->string('observacao');
            $table->float('valor_solicitado');

            $table->foreignId('id_cliente')
                ->nullable()
                ->unsigned()
                ->constrained('cad_cliente', 'id_cliente');

            $table->foreignId('id_proposta')
                ->nullable()
                ->unsigned()
                ->constrained('cad_proposta', 'id_proposta');

            $table->foreignId('id_status_solicitacao')
                ->unsigned()
                ->constrained('cad_status_solicitacao', 'id_status_solicitacao');

            $table->foreignId('id_motivo_finalizacao_solicitacao')
                ->nullable()
                ->unsigned()
                ->constrained('cad_motivo_finalizacao_solicitacao', 'id_motivo_finalizacao_solicitacao');

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
