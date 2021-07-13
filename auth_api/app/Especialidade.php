<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
	use SoftDeletes;

    protected $fillable = ['descricao'];

    public function medicos(){
        return $this->hasMany('App\MedicosEspecialidade', 'especialidades_id');
    }

    public function perguntas(){
        return $this->hasMany('App\Pergunta', 'especialidade_id');
    }
}
