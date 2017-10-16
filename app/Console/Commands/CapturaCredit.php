<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use App\User;
use Carbon\Carbon;
use App\Jobs\capture;
use App\Jobs\teste;
use App\Jobs\Cancelar;
use Illuminate\Foundation\Bus\DispatchesJobs;
class CapturaCredit extends Command
{
    use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capturar:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         
 
         $order = Order::where('status','AuthorizedPendingCapture')->where('created_at', '<=', Carbon::now()->subDays(7)->toDateTimeString());
                   
              if($order->count() > 0){     
                 foreach ($order->get() as $key => $value) {  
                     //get users
                     $user = User::find($value->user_id);
                     $porcentDescont = 0;
                     $valor = 0;


                      //verificar pontuação
                     if($user->cupon->quantidade >= 5){
                          $porcentDescont = 5 * 20; 
                     }else{
                         $porcentDescont = $user->cupon->quantidade * 20; 
                     }

                     $porcentDescont = $porcentDescont >= 100 ? 100 : $porcentDescont;
                      
                     //se a porcentagem for de 100% cencelar a transação
                     if($porcentDescont == 100){
                        //cancelar a capturar
                        $this->dispatch(new Cancelar($value->OrderKey));
                     }else{
                     
                        //dar desconto
                        $valor = $value->valor - ($value->valor * ($porcentDescont / 100));
                        //$this->info('Test.'.$value->OrderKey.'/'.$valor.'/'.$value->TransactionKey);  
                        //capturar
                        $this->dispatch(new capture($value->OrderKey,$valor,$value->TransactionKey));

                        //mandar email
                     } 

                     
                 }
              }
    }
}
