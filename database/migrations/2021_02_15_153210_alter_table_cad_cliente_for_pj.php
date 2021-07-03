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

            $table->foreignId('id_porte_empresa')
                ->nullable()
                ->unsigned()
                ->constrained('cad_porte_empresa', 'id_porte_empresa');

            $table->decimal('rendimento_mensal', 12, 2)
                ->nullable();

            $table->decimal('faturamento_anual', 12, 2)
                ->nullable();

            $table->decimal('capital_social', 12, 2)
                ->nullable();

            $table->integer('ano_faturamento')
                ->nullable();

            $table->foreignId('id_cosif')
                ->nullable()
                ->constrained('cad_cosif', 'id_cosif');

            $table->foreignId('id_tipo_empresa')
                ->nullable()
                ->constrained('cad_tipo_empresa', 'id_tipo_empresa');
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
            $table->dropColumn('id_porte_empresa');
            $table->dropColumn('rendimento_mensal');
            $table->dropColumn('faturamento_anual');
            $table->dropColumn('capital_social');
            $table->dropColumn('ano_faturamento');
            $table->dropColumn('id_cosif');
            $table->dropColumn('id_tipo_empresa');
        });
    }
}
