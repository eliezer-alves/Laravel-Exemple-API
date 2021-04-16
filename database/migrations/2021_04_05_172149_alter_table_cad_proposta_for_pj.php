<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCadPropostaForPj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_proposta', function (Blueprint $table) {
            $table->integer('id_simulacao')
                ->nullable();

            $table->string('cnpj_beneficiario')
                ->nullable();

            $table->string('estado_civil')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cad_proposta', function (Blueprint $table) {
            // $table->string('estado_civil')->nullable(false)->change();
            $table->dropColumn('cnpj_beneficiario');
            $table->dropColumn('id_simulacao');
        });
    }
}