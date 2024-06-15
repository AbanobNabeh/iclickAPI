<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $otp;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$otp,$name)
    {
        $this->email = $email;
        $this->otp = $otp;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('auth.verifyaccount');
    }
}
