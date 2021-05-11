<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoProposta extends Model
{
    use HasFactory;

    protected $table = 'cad_arquivo_proposta';
    protected $primaryKey =  'id_arquivo_proposta';

    protected $fillable = [
    	'id_proposta',
        'link'
    ];

    public function proposta()
    {
        return $this->belongsTo(Proposta::class, 'id_porposta', 'id_proposta');
    }
}
