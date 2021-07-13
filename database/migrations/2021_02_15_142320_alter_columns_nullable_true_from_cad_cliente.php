<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsNullableTrueFromCadCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_cliente', function (Blueprint $table) {
            $table->string('cpf', 14)->nullable()->change();
            $table->string('rg', 15)->nullable()->change();
            $table->string('nome', 200)->nullable()->change();
            $table->date('data_nascimento')->nullable()->change();
            $table->string('sexo', 1)->nullable()->change();
            $table->string('nome_mae', 200)->nullable()->change();
            $table->string('celular', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @warning Para essa ação provavelmente naõ vai ser possível executar seu método down, pos se houver algum registro com algum desses campos null a migration vai falhar!
     * @return void
     */
    public function down()
    {
        Schema::table('cad_cliente', function (Blueprint $table) {
            // $table->string('cpf')->nullable(false)->change();
            // $table->string('rg')->nullable(false)->change();
            // $table->string('nome')->nullable(false)->change();
            // $table->string('data_nascimento')->nullable(false)->change();
            // $table->string('sexo')->nullable(false)->change();
            // $table->string('nome_mae')->nullable(false)->change();
        });
    }
}
