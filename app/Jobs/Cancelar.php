<?php

namespace App\Jobs;
use App\Libs\Stone\CancelarParcial;
use App\Jobs\Job;
use App\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Cancelar extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
   public $orderKey = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($in)
    {
          $this->orderKey = $in;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $auth = new CancelarParcial($this->orderKey);
        $auth->Cancelar();

 
       if($auth->getStatus() != false){
            $transation = $auth->getResponse();
            $order = Order::where('OrderKey',$this->orderKey)->get();
            if(count($order) > 0){
                  $order[0]->status = $transation->CreditCardTransactionResultCollection[0]->CreditCardTransactionStatus == 'Voided' ? 'free' :$transation->CreditCardTransactionResultCollection[0]->CreditCardTransactionStatus;
                  $order->save();
            }
       }
    }
}
