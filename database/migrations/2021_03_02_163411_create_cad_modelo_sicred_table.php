<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadModeloSicredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_modelo_sicred', function (Blueprint $table) {
            $table->id('id_modelo_sicred');
            $table->string('modelo')
                ->unique();
            $table->string('empresa');
            $table->string('agencia');
            $table->string('loja');
            $table->string('lojista');
            $table->string('produto');
            $table->string('plano');
            $table->decimal('taxa', 8, 2)
                ->default(0);
            $table->foreignId('id_client_sicred')
                ->nullable()
                ->unsigned()
                ->constrained('cad_client_sicred', 'id_client_sicred');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_modelo_sicred');
    }
}
