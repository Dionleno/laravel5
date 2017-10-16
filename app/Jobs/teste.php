<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Mail\Mailer;
use Mail;
use App\User;
class teste extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find(11);
         Mail::send('emails.teste',['user' => $user], function ($m) {
             $m->from('algoritmodosucesso@gmail.com', 'Algoritmo do sucesso!');

             $m->to('algoritmodosucesso@gmail.com', 'dionleno vidaletti')->subject('teste');
          });
    }
}
