<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadClientSicredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_client_sicred', function (Blueprint $table) {
            $table->id('id_client_sicred');
            $table->string('environment');
            $table->string('grant_type');
            $table->string('username');
            $table->string('password');
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('scope');
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
        Schema::table('cad_client_sicred', function (Blueprint $table) {
            Schema::dropIfExists('cad_client_sicred');
        });
    }
}
