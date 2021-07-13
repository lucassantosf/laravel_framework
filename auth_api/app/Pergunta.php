<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
	use SoftDeletes;

    protected $table = 'perguntas';

    protected $fillable = [
        'user_id', 'especialidade_id', 'texto', 'replica', 'transacao_id'
    ];

    public function resposta(){
        return $this->belongsTo('App\Resposta','id','pergunta_id');
    }

    public function avaliacao(){
        return $this->belongsTo('App\Avaliacao','id','pergunta_id');
    }

    public function especialidade(){
        return $this->belongsTo('App\Especialidade','especialidade_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

}
