<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = "avaliacoes";

    /* Array de campos protegidos a serem gravados no banco. Ao usar [body] ele aceitará TODOS os campos. */
    protected $fillable = [ 
    	'pergunta_id', 'user_id', 'medico_id', 'avaliacao',
    ];

    public function user(){
		return $this->belongsTo('App\User','user_id');
	}

	public function medico(){
		return $this->belongsTo('App\User','user_id');
	}

	public function pergunta(){
		return $this->belongsTo('App\Pergunta','pergunta_id');
	}
}