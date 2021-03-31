<?php

namespace App\Models;

use App\Models\ClientSicred;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModeloSicred extends Model
{
    use HasFactory;

    protected $table = 'cad_modelo_sicred';
    protected $primaryKey = 'id_modelo_sicred';

    protected $fillable = [
        'modelo',
        'empresa',
        'agencia',
        'loja',
        'lojista',
        'produto',
        'cosif',
        'plano',
        'taxa',
        'id_client_sicred'
    ];

    public function clientSicred()
    {
        return $this->belongsTo(ClientSicred::class, 'id_client_sicred');
    }
}
