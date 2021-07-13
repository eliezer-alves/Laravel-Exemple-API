<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PorteEmpresa extends Model
{
    use HasFactory;

    protected $table = 'porte_empresa';

    protected $fillable = [
        'descricao'
    ];
}
