<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    use SoftDeletes;

    protected $table = 'assinaturas';

    protected $fillable = [
        'user_id','subscription_id','pagarme_plan_id','api_plan_id','current_period_start','current_period_end','status',
    ];

    public function userespecialidades(){
        return $this->hasMany('App\UserEspecialidade');
    }

    public function logs(){
        return $this->hasMany('App\AssinaturaLog','assinatura_id');
    }
}
