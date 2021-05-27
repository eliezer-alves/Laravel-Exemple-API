<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEmpresa extends Model
{
    use HasFactory;

    protected $table = 'cad_tipo_empresa';
    protected $primaryKey = 'id_tipo_empresa';

    protected $fillable = [
        'descricao'
    ];
}
