<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    //Relacionamento 1 para muitos
    public function duracoes()
    {
        //     $this->hasMany(relação, chave estrangeira da relação, primary key local);
        return $this->hasMany('App\Duracoes', 'id_evento', 'id');
    }
}
