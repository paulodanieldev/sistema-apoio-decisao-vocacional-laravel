<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;
 
    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  
        return $this->from(env('MAIL_FROM_ADDRESS'))->subject('Recuperar Senha')->view(
                        'mail.forgot-password', 
                        [
                            'details'=> $this->details
                        ]
                    );
    }
}
