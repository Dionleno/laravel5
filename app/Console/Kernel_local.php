<?php

namespace App\Console;
use App\Jobs\capture;
use App\Jobs\teste;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Insteresse;
use App\Order;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\SendEmails::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('emails:send --force')->daily();
        /*
         $schedule->call(function () {
               
              $order = Order::where('status','AuthorizedPendingCapture');
              if($order->count() > 0){
                 foreach ($order as $key => $value) {
                      $this->dispatch(new capture($value->OrderKey));
                 }
              }
              
          })->yearly();*/
    }
}