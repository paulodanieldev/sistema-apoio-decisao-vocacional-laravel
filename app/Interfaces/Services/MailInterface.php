<?php

namespace App\Interfaces\Services;

use Illuminate\Contracts\Mail\Mailable as MailableContract;

interface MailInterface
{
    /**
     * Send a new mailable message instance.
     * @param string $email
     * @param  \Illuminate\Contracts\Mail\Mailable  $mailable
     * @return void
     */
    public function sendTo(string $email, MailableContract $mailable): void;

    /**
     * Send a new mailable message instance.
     * @param string $email
     * @param string $ccEmail
     * @param  \Illuminate\Contracts\Mail\Mailable  $mailable
     * @return void
     */
    public function sendToCc(string $email, string $ccEmail, MailableContract $mailable): void;

    /**
     * @param string $email
     * @param string $code
     * @return void
     */
    public function sendValidateEmail(string $email, string $code): void;

    /**
     * @param string $email
     * @param string $name
     * @return void
     */
    public function sendSignupEmail(string $email, string $name): void;

    /**
     * @param string $email
     * @param string $token
     * @return void
     */
    public function sendForgotPassword(string $email, string $token): void;

    /**
     * @param string $email
     * @param string $url
     * @return void
     */
    public function sendAppForgotPassword(string $email, string $url): void;

}
