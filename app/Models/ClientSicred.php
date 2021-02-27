<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UrlSicred;

class ClientSicred extends Model
{
    use HasFactory;

    protected $table = 'cad_client_sicred';
    protected $primaryKey = 'id_client_sicred';

    protected $fillable = [
        'environment',
        'grant_type',
        'username',
        'password',
        'client_id',
        'client_secret',
        'scope',
        'batch'
    ];

    public function urls()
    {
        return $this->hasOne(UrlSicred::class, 'id_client_sicred');
    }
}
