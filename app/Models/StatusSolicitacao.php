<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusSolicitacao extends Model
{
    use HasFactory;

    protected $table = 'cad_status_solicitacao';
    protected $primaryKey =  'id_status_solicitacao';

    protected $fillable = [
    	'descricao'
    ];

    public function solicitacoes()
    {
    	return $this->hasMany(Solicitacao::class, 'id_status_solicitacao');
    }
}