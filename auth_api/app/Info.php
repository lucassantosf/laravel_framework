<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = [
    	'scriptshead',
        'scriptsfoot',
        'googlemaps',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'telefone',
        'email',
        'endereco',
        'termos'
    ];

    /* Função para adicionar a URL do site automaticamente na imagem após puxar do banco
    URL determinada no .env */
    public function getTermosAttribute($value) {
        if($value) {
            return config('app.url').'uploads/infos/'.$value;
        }
    }
}
