<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insteresse extends Model
{
      protected $fillable = [
        'email', 'telefone', 'formulario'
     ];
}
