<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransacaoLog extends Model
{
    protected $table = 'transacoes_logs';

    protected $fillable = [
        'transacao_id','current_status','old_status','log'
    ];
}
