<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public function cliente(){
    	//Jeito mais simplpes seguindo as regras de nomenclatura
    	//return $this->belongsTo('App\Cliente',);
    	//Caso não seguisse as regras de nomenclatura
    	return $this->belongsTo('App\Cliente','cliente_id','id');
    }
}
