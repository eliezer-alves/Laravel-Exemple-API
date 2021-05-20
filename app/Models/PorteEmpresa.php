<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PorteEmpresa extends Model
{
    use HasFactory;

    protected $table = 'cad_porte_empresa';
    protected $primaryKey = 'id_porte_empresa';

    protected $fillable = [
        'descricao'
    ];
}
