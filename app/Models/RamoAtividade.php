<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamoAtividade extends Model
{
    use HasFactory;

    protected $table = 'cad_ramo_atividade';
    protected $primary_key = 'id_ramo_atividade';

    protected $hidden = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    protected $fillable = [
    	'atividade'
    ];

    public function cliente()
    {
    	return $this->hasMany(Cliente::class, 'id_ramo_atividade');
    }
}
