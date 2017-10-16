<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use App\Jobs\capture;
use Illuminate\Foundation\Bus\DispatchesJobs;
class SendEmails extends Command
{
     use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

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
          $order = Order::where('status','AuthorizedPendingCapture');
          
              if($order->count() > 0){     
                 foreach ($order->get() as $key => $value) {
          $this->info('Test.'.$value->OrderKey);            
                      $this->dispatch(new capture($value->OrderKey));
                 }
              }
    }
}
