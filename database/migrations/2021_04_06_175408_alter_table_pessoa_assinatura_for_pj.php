<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePessoaAssinaturaForPj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_pessoa_assinatura', function (Blueprint $table) {
            $table->string('inscricao_estadual')
                ->nullable();

            $table->string('nome_fantasia')
                ->nullable();

            $table->string('razao_social')
                ->nullable();

            $table->foreignId('id_atividade_comercial')
                ->nullable()
                ->unsigned()
                ->constrained('cad_atividade_comercial', 'id_atividade_comercial');

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

            $table->string('estado_civil')
                ->nullable();

            $table->string('telefone')
                ->nullable();

            $table->string('numero_documento_identidade')
                ->nullable();

            $table->string('uf_documento_identidade', 2)
                ->nullable();

            $table->string('tipo_documento_identidade')
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
        Schema::table('cad_pessoa_assinatura', function (Blueprint $table) {
            $table->dropColumn('inscricao_estadual');
            $table->dropColumn('nome_fantasia');
            $table->dropColumn('razao_social');
            $table->dropColumn('id_atividade_comercial');
            $table->dropColumn('tipo_empresa');
            $table->dropColumn('id_porte_empresa');
            $table->dropColumn('rendimento_mensal');
            $table->dropColumn('faturamento_anual');
            $table->dropColumn('capital_social');
            $table->dropColumn('ano_faturamento');
            $table->dropColumn('estado_civil');
            $table->dropColumn('telefone');
            $table->dropColumn('numero_documento_identidade');
            $table->dropColumn('uf_documento_identidade');
            $table->dropColumn('tipo_documento_identidade');
        });
    }
}
