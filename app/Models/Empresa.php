<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresa';

    protected $fillable = [
        'cnpj',
        'inscricao_estadual',
        'nome_fantasia',
        'razao_social',
        'data_fundacao',
        'id_atividade_comercial',
        'id_tipo_empresa',
        'id_porte_empresa',
        'id_cosif',
    ];

    public function atividadeComercial()
    {
        return $this->belongsTo(AtividadeComercial::class, 'id_atividade_comercial');
    }

    public function cosif()
    {
        return $this->belongsTo(Cosif::class, 'id_cosif');
    }

    public function porte()
    {
        return $this->belongsTo(PorteEmpresa::class, 'id_porte_empresa');
    }

    public function tipo()
    {
        return $this->belongsTo(TipoEmpresa::class, 'id_tipo_empresa');
    }
}
