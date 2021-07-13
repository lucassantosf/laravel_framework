<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transacao extends Model
{
    use SoftDeletes;

    protected $table = 'transacoes';

    //Return aditional fields from relationship
    protected $appends = ['descricao'];

    protected $fillable = [
        'user_id','pacote_id','pagarme_transaction_id','perguntas_remaining','especialidades_quantity','especialidades_changes_remaining','status','pagarme_object_json',
    ];

    public function pacote(){
        return $this->belongsTo('App\Pacote','pacote_id');
    }

    public function logs(){
        return $this->hasMany('App\TransacaoLog','transacao_id');
    }

    public function perguntas(){
        return $this->hasMany('App\Pergunta','transacao_id');
    }

    public function getDescricaoAttribute() {
        return $this->pacote->descricao;
    }
}
