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
        'servico',
        'url'
    ];

    public function modelos()
    {
        return $this->belongsToMany(ModeloSicred::class, 'cad_url_modelo_sicred', 'id_url_sicred', 'id_modelo_sicred');
    }
}
