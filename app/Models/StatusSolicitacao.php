<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSolicitacao extends Model
{
    use HasFactory;

    protected $table = 'cad_status_solicitacao_proposta';
    protected $primaryKey =  'id_status_solicitacao_proposta';

    $fillable = [
    	'descricao'
    ];
}
