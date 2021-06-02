<?php

use Doctrine\DBAL\Schema\Constraint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadObservacaoProposta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_observacao_proposta', function (Blueprint $table) {
            $table->id('id_observacao_proposta');
            $table->text('observacao');
            $table->foreignId('id_proposta')
                ->unsigned()
                ->constrained('cad_proposta', 'id_proposta');

            $table->foreignId('id_usuario')
                ->unsigned()
                ->constrained('cad_usuario', 'id_usuario');

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
        Schema::dropIfExists('cad_observacao_proposta');
    }
}
