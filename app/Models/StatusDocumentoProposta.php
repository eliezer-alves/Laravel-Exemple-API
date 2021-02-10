<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusDocumentoProposta extends Model
{
    use HasFactory;

    protected $table = 'cad_status_documento_proposta';
    protected $primaryKey =  'id_status_documento_proposta';

    protected $fillable = [
    	'descricao'
    ];

    public function documentos()
    {
    	return $this->hasMany(DocumentoProposta::class, 'id_status_documento_proposta');
    }
}
