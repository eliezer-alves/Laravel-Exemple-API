<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnIdStatusDocumentoFromCadDocumentoProposta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cad_documento_proposta', function (Blueprint $table) {
            $table->renameColumn('id_status_documento', 'id_status_documento_proposta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cad_documento_proposta', function (Blueprint $table) {
            $table->renameColumn('id_status_documento_proposta', 'id_status_documento');
        });
    }
}
