<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Contracts\Filesystem\Cloud;
use Illuminate\Contracts\Mail\Mailer;
use Mail;

class EmailEbook extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
     private $email = '';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($md)
    {
        $this->email = $md;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

      

       $userx = $this->email;
            Mail::send('emails.download', ['user' => $userx], function ($m) use ($userx) {
             $m->from('algoritmodosucesso@gmail.com', 'Algoritmo do sucesso!');

             $m->to($userx, 'Aluno')->subject('DOWNLOAD EBOOK!');
          });

           
    }
}
