<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UrlSicred;

class ConfiguracaoSicred extends Model
{
    use HasFactory;

    protected $table = 'cad_configuracao_sicred';
    protected $primaryKey = 'id_configuracao_sicred';

    protected $fillable = [
        'grant_type',
        'username',
        'password',
        'client_id',
        'client_secret',
        'scope',
        'id_url_sicred',
        'batch'
    ];

    // public function urlSicred()
    // {
    //     return $this->hasOne(UrlSicred::class, 'id_url_sicred');
    // }
}
