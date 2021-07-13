<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEspecialidadeLog extends Model
{
    protected $table = 'users_especialidades_logs';

    protected $fillable = [
        'user_id','origem','especialidade_id_from','especialidade_id_to','transacao_id'
    ];
}
