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
            $table->integer('id_usuario');

            $table->foreignId('id_proposta')
                ->unsigned()
                ->constrained('cad_proposta', 'id_proposta');

            $table->foreignId('id_status_documento_proposta')
                ->unsigned()
                ->constrained('cad_status_documento_proposta', 'id_status_documento_proposta');

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
