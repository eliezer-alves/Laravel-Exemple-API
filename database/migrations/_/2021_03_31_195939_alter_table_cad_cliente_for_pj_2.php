<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableCadClienteForPj2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_cliente', function (Blueprint $table) {
            $table->string('tipo_empresa')
                ->nullable();
            $table->string('porte')
                ->nullable();
            $table->float('rendimento_mensal')
                ->nullable();
            $table->float('faturamento_anual')
                ->nullable();
            $table->float('capital_social')
                ->nullable();
            $table->integer('ano_faturamento')
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
            $table->dropColumn('tipo_empresa');
            $table->dropColumn('porte');
            $table->dropColumn('rendimento_mensal');
            $table->dropColumn('faturamento_anual');
            $table->dropColumn('capital_social');
            $table->dropColumn('ano_faturamento');
        });
    }
}
