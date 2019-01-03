<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{	
	//Criando o relacionamento um produto percente a uma categoria
	public function categoria(){
    	return $this->belongsTo('App\Categoria');
    }
}
