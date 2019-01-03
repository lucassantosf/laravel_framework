<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function endereco(){
		//Relacionamento UM para UM -> HasOne
    	return $this->hasOne('App\Endereco','cliente_id');
    }

}
