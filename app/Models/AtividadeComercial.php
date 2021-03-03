<?php

namespace App\Models;

use App\Models\Cliente;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadeComercial extends Model
{
    use HasFactory;
    protected $table = 'cad_atividade_comercial';
    protected $primaryKey = 'id_atividade_comercial';

    public $timestamps = true;

    protected $fillable = [
        'descricao'
    ];

    public function cliente()
    {
        return $this->hasMany(Cliente::class, 'id_atividade_comercial');
    }
}
