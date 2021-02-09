<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoPropostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_documento_proposta', function (Blueprint $table) {
            $table->id('id_documento_proposta');
            $table->integer('id_proposta')->constrained('cad_proposta');
            $table->integer('id_usuario');
            $table->integer('id_status_documento');
            $table->string('link');
            $table->text('observacao');
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
        Schema::dropIfExists('cad_documento_proposta');
    }
}
