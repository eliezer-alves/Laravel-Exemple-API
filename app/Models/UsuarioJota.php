<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioJota extends Model
{
    use HasFactory;

    protected $table = 'cad_usuario';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_grupo',
        'nome',
        'identificacao',
        'ultimo_login',
        'ativo',
    ];

    protected $hidden = [
        'senha',
        'date_create',
        'last_update',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
