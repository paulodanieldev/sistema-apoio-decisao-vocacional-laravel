<?php

namespace App\Services;

use App\Interfaces\Services\MailInterface;
use App\Jobs\SendEmail;
use App\Mail\ForgotAppPassword;
use Illuminate\Contracts\Mail\Mailable as MailableContract;
use App\Mail\ForgotPassword;
use App\Mail\SignupEmail;
use App\Mail\ValidateEmail;
use Illuminate\Support\Facades\Config;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_TransportException;

class MailService implements MailInterface
{
    public function __construct()
    {
        //
    }

    /**
     * Send a new mailable message instance.
     * @param string $email
     * @param  \Illuminate\Contracts\Mail\Mailable  $mailable
     * @return void
     */
    public function sendTo(string $email, MailableContract $mailable): void
    {
        try {
            SendEmail::dispatch($mailable, $email);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function validateEmailSettings(): bool
    {
        $defaultMailSettings = Config::get('mail.default');
        $mailSettings = Config::get("mail.mailers.{$defaultMailSettings}");
        $mailFromSettings = Config::get("mail.from");

        $mailHost = $mailSettings["host"];
        $mailPort = $mailSettings["port"];
        $mailUsername = $mailSettings["username"];
        $mailPassword = $mailSettings["password"];
        $mailEncryption = $mailSettings["encryption"];
        $mailFromAddress = $mailFromSettings["address"];
        $mailFromName = $mailFromSettings["name"];

        if (
            $mailHost &&
            $mailPort &&
            $mailUsername &&
            $mailPassword &&
            $mailEncryption &&
            $mailFromAddress &&
            $mailFromName
        ) {
            $isValidSettings = $this->checkSMTPSettings(
                $mailHost,
                $mailPort,
                $mailUsername,
                $mailPassword,
                $mailEncryption
            );

            if ($isValidSettings) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Verifica se as informações de SMTP estão corretas
     * @return boolean
     */
    public function checkSMTPSettings(
        string $mailHost,
        string $mailPort,
        string $mailUsername,
        string $mailPassword,
        string $mailEncryption
    ): bool {
        try {
            $transport = new Swift_SmtpTransport($mailHost, $mailPort, $mailEncryption);
            $transport->setUsername($mailUsername);
            $transport->setPassword($mailPassword);

            $mailer = new Swift_Mailer($transport);
            $mailer->getTransport()->start();

            return true;
        } catch (Swift_TransportException $error) {
            // return $error->getMessage();
            return false;
        } catch (\Exception $error) {
            // return $error->getMessage();
            return false;
        }
    }

    /**
     * Send a new mailable message instance.
     * @param string $email
     * @param string $ccEmail
     * @param  \Illuminate\Contracts\Mail\Mailable  $mailable
     * @return void
     */
    public function sendToCc(string $email, string $ccEmail, MailableContract $mailable): void
    {
        try {
            SendEmail::dispatch($mailable, $email, $ccEmail);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * @param string $email
     * @param string $code
     * @return void
     */
    public function sendValidateEmail(string $email, string $code): void
    {
        $data = [
            'email' => $email,
            'code' => $code
        ];

        $this->sendTo($email, new ValidateEmail($data));
    }

    /**
     * @param string $email
     * @param string $name
     * @return void
     */
    public function sendSignupEmail(string $email, string $name): void
    {
        $data = [
            'name' => $name
        ];

        $this->sendTo($email, new SignupEmail($data));
    }

    /**
     * @param string $email
     * @param string $token
     * @return void
     */
    public function sendForgotPassword(string $email, string $token): void
    {
        $data = [
            'token' => $token
        ];

        $this->sendTo($email, new ForgotPassword($data));
    }

    /**
     * @param string $email
     * @param string $url
     * @return void
     */
    public function sendAppForgotPassword(string $email, string $url): void
    {
        $data = [
            'url' => $url
        ];

        $this->sendTo($email, new ForgotAppPassword($data));
    }

}
