<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicosEspecialidade extends Model
{
    protected $fillable = ['user_id', 'especialidade_id'];

    public function especialidade(){
    	return $this->belongsTo('App\Especialidade');
    }

    public function medico(){
    	return $this->belongsTo('App\User');
    }
}
