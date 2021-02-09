<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnPropostaFromLogSolicitacaoProposta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_solicitacao_proposta', function (Blueprint $table) {
            $table->dropColumn('proposta');
            $table->integer('id_proposta')->constrained('cad_proposta')->afeter('id_solicitacao_proposta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_solicitacao_proposta', function (Blueprint $table) {
            $table->dropColumn('id_proposta');
            $table->integer('proposta');
        });
    }
}
