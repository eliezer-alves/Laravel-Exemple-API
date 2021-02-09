<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientePjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cd_cliente_pj', function (Blueprint $table) {
            $table->id('id_cliente_pj');
            $table->number('cnpj');
            $table->string('inscricao_estadual');
            $table->string('nome_fantasia');
            $table->string('razao_social');
            $table->string('ramo_atividade');
            $table->string('celular');
            $table->string('telefone');
            $table->string('email');
            $table->string('senha');
            $table->string('cep');
            $table->string('uf');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('logradouro');
            $table->number('id_tipo_logradouro')->constrained('cad_tipo_logradouro');
            $table->number('numero');
            $table->string('complemento');
            $table->number('id_forma_inclusao')->constrained('cad_forma_inclusao');
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
        Schema::dropIfExists('cd_cliente_pj');
    }
}
