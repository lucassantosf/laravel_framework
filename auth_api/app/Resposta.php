<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
	use SoftDeletes;
	
    protected $table = 'respostas';
    
    protected $fillable = [
        'user_id', 'pergunta_id', 'replica', 'texto'
    ];
 	
 	public function user(){
        return $this->belongsTo('App\User','user_id');
    } 
}
