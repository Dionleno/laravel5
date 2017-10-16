<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{  
      protected $fillable = [
        'titularCartao', 'parcelas', 'bandeira','valor','valor_desconto','cupom','user_id','status','OrderKey','TransactionKey'
     ];
 
      public function user(){
        return $this->belongsTo('App\User');
      }

      public function getFormattedPriceAttribute(){
         
          return $this->formata_preco($this->valor);
      }

        private function formata_preco($valor)
        {
            $negativo = false;
            $preco = "";
            $valor = intval(trim($valor));
            if ($valor < 0) {
                $negativo = true;
                $valor = abs($valor);
            }
            $valor = strrev($valor);
            while (strlen($valor) < 3) {
                $valor .= "0";
            }
            for ($i = 0; $i < strlen($valor); $i++)
            {
                if ($i == 2)
                {
                    $preco .= ",";
                }
                if (($i <> 2) AND (($i+1)%3 == 0))
                {
                    $preco .= ".";
                }
                $preco .= substr($valor, $i , 1);
            }
            $preco = strrev($preco);
            return ($negativo ? "-" : "") . $preco;
        }
 
}
