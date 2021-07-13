<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pacote extends Model
{
    use SoftDeletes;

    protected $table = 'pacotes';

    protected $fillable = [
        'descricao','valor','especialidades','perguntas','trocas_especialidade','status'
    ];
}
