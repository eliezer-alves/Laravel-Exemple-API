<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAnalisePessoaProposta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_analise_pessoa_proposta', function (Blueprint $table) {
            $table->id('id_analise_pessoa_proposta');

            $table->foreignId('id_proposta')
                ->constrained('cad_proposta', 'id_proposta');

            $table->foreignId('id_analise_proposta')
                ->constrained('cad_analise_proposta', 'id_analise_proposta');

            $table->foreignId('id_pessoa_assinatura')
                ->constrained('cad_pessoa_assinatura', 'id_pessoa_assinatura');

            $table->integer('id_spc_brasil')
                ->nullable()
                ->unsigned();

            $table->integer('id_scpc')
                ->nullable()
                ->unsigned();

            $table->integer('id_confirme_online')
                ->nullable()
                ->unsigned();

            $table->integer('id_info_mais')
                ->nullable()
                ->unsigned();

            $table->integer('id_score')
                ->nullable()
                ->unsigned();

            $table->integer('id_scr')
                ->nullable()
                ->unsigned();

            $table->float('restricao', 8, 2)
                ->nullable();

            $table->float('score', 8, 2)
                ->nullable();

            $table->string('classificacao_score')
                ->nullable();

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
        Schema::dropIfExists('cad_analise_pessoa_proposta');
    }
}
