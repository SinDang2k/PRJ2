<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $token;
    public $time_out;
    public $position;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$token,$time_out,$position)
    {
        $this->name = $name;
        $this->token = $token;
        $this->time_out = $time_out;
        $this->position = $position;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.forgot_password');
    }
}
