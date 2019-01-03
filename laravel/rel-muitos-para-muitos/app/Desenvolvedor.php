<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{	
	//este comando ira fazer o plural irregular da tabela
    protected $table = 'desenvolvedores';    

    //relacionamento
    public function projetos2(){
    	return $this->belongsToMany("App\Projeto","alocacoes")->withPivot('horas_semanais');
    }
}
