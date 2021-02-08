<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;

    protected $table = 'log_solicitacao_proposta';

    protected $fillable = [
    	'cnpj',
    	'valor_solicitado',
    	'proposta',
    	'id_status_solicitacao',
    	'id_motivo_finalizacao',
    	'observacao',
    	'celular_envio_link',
    	'email_envio_link'
    ];
}
