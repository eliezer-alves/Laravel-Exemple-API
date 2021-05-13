<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadUrlModeloSicred extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_url_modelo_sicred', function (Blueprint $table) {
            $table->id('id_url_modelo_sicred');
            $table->foreignId('id_url_sicred')
                ->unsigned()
                ->constrained('cad_url_sicred', 'id_url_sicred');
            $table->foreignId('id_modelo_sicred')
                ->unsigned()
                ->constrained('cad_modelo_sicred', 'id_modelo_sicred');
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
        Schema::dropIfExists('cad_url_modelo_sicred');
    }
}
