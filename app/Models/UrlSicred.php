<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ConfiguracaoSicred;

class UrlSicred extends Model
{
    use HasFactory;

    protected $table = 'cad_url_sicred';
    protected $primaryKey = 'id_url_sicred';

    protected $fillable = [
        'base_url',
        'athentication_url',
        'simulacao_url',
        'proposta_url',
        'proposta_v2_url',
        'contrato_url'
    ];

    // public function configuracaoSicred()
    // {
    //     return $this->belongsTo(ConfiguracaoSicred::class, 'id_url_sicred');
    // }
}
