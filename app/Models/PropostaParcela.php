<?php

namespace App\Models;

use App\Models\Proposta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropostaParcela extends Model
{
    use HasFactory;

    protected $table = 'cad_proposta_parcela';
    protected $primaryKey =  'id_proposta_parcela';

    protected $fillable = [
        'id_proposta',
        'numero_parcela',
        'vencimento',
        'valor',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'id_proposta', 'id_proposta');
    }
}
