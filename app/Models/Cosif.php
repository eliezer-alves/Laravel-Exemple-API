<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cosif extends Model
{
    use HasFactory;

    protected $table = 'cad_cosif';
    protected $primaryKey = 'id_cosif';

    protected $fillable = [
        'descricao'
    ];
}
