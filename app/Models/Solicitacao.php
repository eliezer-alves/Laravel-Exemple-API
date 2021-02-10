<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;

    protected $table = 'log_solicitacao_proposta';
    protected $primaryKey =  'id_solicitacao_proposta';

    protected $fillable = [
        'id_cliente',
    	'valor_solicitado',
    	'id_proposta',
    	'id_status_solicitacao',
    	'id_motivo_finalizacao',
    	'observacao'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function proposta()
    {
        return $this->hasOne(Proposta::class, 'id_proposta'); 
    }

    public function status()
    {
        return $this->hasOne(StatusSolicitacao::class, 'id_status_solicitacao');
    }

    public function motivoFinalizacao()
    {
        return $this->belongsTo(MotivoFinalizacao::class, 'id_motivo_finalizacao_solicitacao');
    }
}
