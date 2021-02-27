<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientSicred;

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
        'contrato_url',
        'id_client_sicred'
    ];

    public function clientSicred()
    {
        return $this->belongsTo(ClientSicred::class, 'id_client_sicred');
    }
}
