<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLogAnaliseManualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_analise_manual', function (Blueprint $table) {
            $table->foreignId('id_proposta')
                ->nullable()
                ->constrained('cad_proposta', 'id_proposta');

            $table->foreignId('id_tipo_proposta')
                ->nullable()
                ->constrained('cad_tipo_proposta', 'id_tipo_proposta');

            $table->string('observacao')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_analise_manual', function (Blueprint $table){
            $table->dropColumn('id_proposta');
            $table->dropColumn('id_tipo_proposta');
            $table->dropColumn('observacao');
        });
    }
}
