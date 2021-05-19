<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusAnaliseProposta extends Model
{
    use HasFactory;

    protected $table = 'cad_status_analise_proposta';
    protected $primaryKey = 'id_status_analise_proposta';

    protected $fillable = [
        'descricao'
    ];
}
