<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAnaliseProposta extends Model
{
    use HasFactory;

    protected $table = 'log_analise_manual';
    protected $primaryKey = 'id_log_analise_manual';

    protected $fillable = [
        'id_analise_proposta',
        'id_usuario_analise_manual',
        'id_status_anterior',
        'id_status_atual',
        'data_hora_inicio_analise',
        'valor_liberacao',
        'data_hora_fim_analise_manual',
        'id_proposta',
        'id_tipo_proposta',
    ];

    public $timestamps = false;

    public function usuario()
    {
        return $this->belongsTo(UsuarioJota::class, 'id_usuario_analise_manual');
    }
}
