<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
	use SoftDeletes;
	
    protected $table = 'cartoes';
    
    protected $fillable = [
        'user_id','brand','card_hash','holder_name','last_digits','expiration_date','cvv'
    ]; 
    
}