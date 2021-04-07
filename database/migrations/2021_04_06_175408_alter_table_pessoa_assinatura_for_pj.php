<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePessoaAssinaturaForPj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_pessoa_assinatura', function (Blueprint $table) {
            $table->string('estado_civil')
                ->nullable();

            $table->string('numero_documento_identidade')
                ->nullable();

            $table->string('uf_documento_identidade', 2)
                ->nullable();

            $table->string('tipo_documento_identidade')
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
        Schema::table('cad_pessoa_assinatura', function (Blueprint $table) {
            $table->dropColumn('estado_civil');
            $table->dropColumn('numero_documento_identidade');
            $table->dropColumn('uf_documento_identidade');
            $table->dropColumn('tipo_documento_identidade');
        });
    }
}
