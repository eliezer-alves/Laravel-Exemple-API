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

            $table->string('telefone')
                ->nullable();

            $table->foreignId('id_atividade_comercial')
                ->nullable()
                ->unsigned()
                ->constrained('cad_atividade_comercial', 'id_atividade_comercial');

            $table->timestamp('data_fundacao', $precision = 0)
                ->nullable();

            $table->string('tipo_empresa')
                ->nullable();

            $table->foreignId('id_porte_empresa')
                ->nullable()
                ->unsigned()
                ->constrained('cad_porte_empresa', 'id_porte_empresa');

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
            $table->dropColumn('cnpj');
            $table->dropColumn('inscricao_estadual');
            $table->dropColumn('nome_fantasia');
            $table->dropColumn('razao_social');
            $table->dropColumn('telefone');
            $table->dropColumn('id_atividade_comercial');
            $table->dropColumn('data_fundacao');
            $table->dropColumn('tipo_empresa');
            $table->dropColumn('id_porte_empresa');
            $table->dropColumn('rendimento_mensal');
            $table->dropColumn('faturamento_anual');
            $table->dropColumn('capital_social');
            $table->dropColumn('ano_faturamento');
        });
    }
}
