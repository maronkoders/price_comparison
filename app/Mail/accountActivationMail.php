<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class accountActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.users.account_activation')
                    ->with(['user'=>$this->user]);
    }
}
