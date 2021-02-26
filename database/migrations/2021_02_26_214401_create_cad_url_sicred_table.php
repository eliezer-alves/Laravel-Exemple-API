<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadUrlSicredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_url_sicred', function (Blueprint $table) {
            $table->id('id_url_sicred');
            $table->string('base_url')
                ->nullable();
            $table->string('athentication_url')
                ->nullable();
            $table->string('simulacao_url')
                ->nullable();
            $table->string('proposta_url')
                ->nullable();
            $table->string('proposta_v2_url')
                ->nullable();
            $table->string('contrato_url')
                ->nullable();
            $table->string('contrato_v2_url')
                ->nullable();
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
        Schema::table('cad_url_sicred', function (Blueprint $table) {
            Schema::dropIfExists('cad_url_sicred');
        });
    }
}
