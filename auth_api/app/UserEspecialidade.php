<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEspecialidade extends Model
{
    protected $table = 'users_especialidades';
    
    protected $fillable = [
        'user_id', 'especialidade_id'
    ]; 

    public function especialidade(){
        return $this->belongsTo('App\Especialidade', 'especialidade_id');
    }
}