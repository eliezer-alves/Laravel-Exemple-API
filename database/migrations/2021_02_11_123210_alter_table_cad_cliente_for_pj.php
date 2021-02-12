<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCadClienteForPj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_cliente', function (Blueprint $table) {
            $table->string('cnpj')
                ->nullable()
                ->unique();

            $table->string('inscricao_estadual')
                ->nullable();

            $table->string('nome_fantasia')
                ->nullable();

            $table->string('razao_social')
                ->nullable();

            $table->string('ramo_atividade')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cad_cliente', function (Blueprint $table) {
            $table->dropColumn('cnpj')
                ->unique();

            $table->dropColumn('inscricao_estadual');
            $table->dropColumn('nome_fantasia');
            $table->dropColumn('razao_social');
            $table->dropColumn('ramo_atividade');
        });
    }
}
