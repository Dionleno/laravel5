<?php

namespace App\Jobs;
use App\Libs\Stone\CraditCaptureTransation;
use App\Jobs\Job;
use App\Order;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Mail\Mailer;
use Mail;
class capture extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    
    public $orderKey = 0;
    public $valor = 0;
    public $transKey = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($in,$v,$key)
    {
        
        $this->orderKey = $in;
        $this->valor = $v;
        $this->transKey = $key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {       
       $authCapture = new CraditCaptureTransation($this->orderKey,$this->valor,$this->transKey);
       $authCapture->createCapture();
    
       if($authCapture->getStatus() != false){
      
   
            $transation = $authCapture->getResponse();
            $order = Order::where('OrderKey',$this->orderKey)->get();
            if(count($order) > 0){
                  $order[0]->status = $transation->CreditCardTransactionResultCollection[0]->CreditCardTransactionStatus;
                  $order[0]->valor = $this->valor;
                  $order[0]->save();
          
          
           if($order[0]->status == 'Captured'){
              $user = User::find($order[0]->user_id);
              
                  //enviar email

               $norder = [
                  'valor'=>$this->formata_preco($order[0]->valor),
                  'valor_desconto'=>$this->formata_preco($order[0]->valor_desconto)
               ];

                Mail::send('emails.pagamento_aprovado', ['user' => $user,'order'=>$norder], function ($m) use ($user) {
                    $m->from('algoritmodosucesso@gmail.com', 'Algoritmo do sucesso!');

                    $m->to($user->email, $user->name)->subject('PAGAMENTO APROVADO!');
                });
              }
            }

        


       }else{
            $order = Order::where('OrderKey',$this->orderKey)->get();
            if(count($order) > 0){
                  $order[0]->status = 'NotAuthorized';              
                  $order[0]->save();
            }
       } 
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
