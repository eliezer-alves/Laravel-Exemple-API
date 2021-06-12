<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProposta extends Model
{
    use HasFactory;
    protected $table = 'cad_tipo_proposta';
    protected $primaryKey = 'id_tipo_proposta';

    protected $fillable = [
        'descricao'
    ];
}
