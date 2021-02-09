<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoFinalizacao extends Model
{
    use HasFactory;

    protected $table = 'cad_motivo_finalizacao_solicitacao';
    protected $primaryKey =  'id_motivo_finalizacao_solicitacao';

    protected $fillable = [
    	'descricao'
    ];
}
