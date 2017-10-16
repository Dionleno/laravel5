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
class EmailSend extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    private $user , $tipo_email , $info = '';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tipo_email,$user,$info)
    {
        $this->user = $user;
        $this->tipo_email = $tipo_email;
        $this->info = $info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $userMail = $this->user;
        $infoMail = $this->info;

         Mail::send('emails.'.$this->tipo_email, ['user' => $userMail], function ($m) use ($userMail, $infoMail) {
             $m->from('algoritmodosucesso@gmail.com', 'Algoritmo do sucesso!');

             $m->to($userMail->email, $userMail->name)->subject($infoMail);
          });
    }
}
