<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
     protected $fillable = [
        'cupom', 'quantidade','porcentagem','maximo','status'
     ];

      public function user(){
        return $this->belongsTo('App\User');
      }
}
