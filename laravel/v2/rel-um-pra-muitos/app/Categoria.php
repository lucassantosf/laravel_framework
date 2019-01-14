<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{	
	//Lado 1 no relacionamento 1 para muitos
    public function produtos(){
    	return $this->hasMany('App\Produto');
    }
}
