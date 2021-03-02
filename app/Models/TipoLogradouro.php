<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLogradouro extends Model
{
    use HasFactory;

    protected $table = 'cad_tipo_logradouro';
    protected $primaryKey = 'id_tipo_logradouro';

    protected $fillable = [
        'descricao'
    ];
}
