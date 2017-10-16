<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','telefone','documento','ndocumento','carteira'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];


      public function order(){
        return $this->hasMany('App\Order');
      }

      public function cupon(){
        return $this->hasOne('App\Cupon');
      }
 


}
