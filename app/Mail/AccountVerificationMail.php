<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    public function __construct($email)
    {
        $this->email  = $email;
    }

    public function build()
    {
        $user = User::where('email', $this->email)->first();
        return $this->markdown('emails.users.verificationMail')->with(['user'=> $user]);
    }
}
