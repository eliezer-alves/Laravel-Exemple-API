<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadConfiguracaoSicredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_configuracao_sicred', function (Blueprint $table) {
            $table->id('id_configuracao_sicred');
            $table->string('batch');
            $table->string('grant_type');
            $table->string('username');
            $table->string('password');
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('scope');
            $table->foreignId('id_url_sicred')
                ->nullable()
                ->unsigned()
                ->constrained('cad_url_sicred', 'id_url_sicred');
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
        Schema::table('cad_configuracao_sicred', function (Blueprint $table) {
            Schema::dropIfExists('cad_configuracao_sicred');
        });
    }
}
