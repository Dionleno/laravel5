<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Mail\Mailer;
use Mail;

class Ebook extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        echo 'teste';
        
          $userx = 'algoritmodosucesso@gmail.com';
            Mail::send('emails.download', ['user' => $userx], function ($m) use ($userx) {
             $m->from('algoritmodosucesso@gmail.com', 'Algoritmo do sucesso!');

             $m->to($userx, 'Aluno')->subject('DOWNLOAD EBOOK!');
          });

        
    }
}
