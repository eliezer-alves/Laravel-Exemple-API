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
        'id_status_documento_proposta',
        'link',
        'observacao',
    ];

    public function proposta()
    {
        return $this->belongsTo(Proposta::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusDocumentoProposta::class, 'id_status_documento_proposta');
    }
}
