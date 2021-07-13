<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj')
                ->nullable()
                ->unique();

            $table->string('inscricao_estadual')
                ->nullable();

            $table->string('nome_fantasia')
                ->nullable();

            $table->string('razao_social')
                ->nullable();
            $table->timestamps();

            $table->timestamp('data_fundacao', $precision = 0)
                ->nullable();

            $table->foreignId('id_atividade_comercial')
                ->nullable()
                ->unsigned()
                ->constrained('atividade_comercial');

            $table->foreignId('id_porte_empresa')
                ->nullable()
                ->unsigned()
                ->constrained('porte_empresa');
            
            $table->foreignId('id_cosif')
                ->nullable()
                ->constrained('cosif');

            $table->foreignId('id_tipo_empresa')
                ->nullable()
                ->constrained('tipo_empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
