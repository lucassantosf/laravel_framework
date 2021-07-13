<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssinaturaLog extends Model
{
    protected $table = 'assinaturas_logs';

    protected $fillable = [
        'assinatura_id','current_status','old_status','log'
    ];

}
