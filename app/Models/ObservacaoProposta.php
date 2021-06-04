<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObservacaoProposta extends Model
{
    use HasFactory;

    protected $table = 'cad_observacao_proposta';

    protected $primaryKey = 'id_observacao_proposta';

    protected $fillable = [
        'observacao',
        'id_proposta',
        'id_usuario'
    ];

    public function usuario()
    {
        return $this->belongsTo(UsuarioJota::class, 'id_usuario');
    }
}
