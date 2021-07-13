<?php

namespace App\Models;

use App\Models\Cliente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadeComercial extends Model
{
    use HasFactory;
    protected $table = 'atividade_comercial';

    public $timestamps = true;

    protected $fillable = [
        'descricao'
    ];
}
