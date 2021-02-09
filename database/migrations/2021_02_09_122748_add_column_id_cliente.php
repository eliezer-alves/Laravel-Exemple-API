<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_solicitacao_proposta', function (Blueprint $table) {            
            $table->integer('id_cliente')->constrained('cad_cliente')->after('id_solicitacao_proposta');
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
            $table->dropColumn('id_cliente');
        });
    }
}
