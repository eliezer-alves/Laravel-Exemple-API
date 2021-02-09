<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoProposta extends Model
{
    use HasFactory;

    protected $table = 'cad_documento_proposta';
    protected $primaryKey =  'id_documento_proposta';

    protected $fillable = [
    	'id_proposta',
    	'id_usuario',
    	'link',
    	'observacao',
    	'id_status_documento'
    ];
}
