<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    public function desenvolvedores(){
    	return $this->belongsToMany('App\Desenvolvedor','alocacoes')->withPivot('horas_semanais');
    }
}
