<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\{ForgotRequest};
use App\Http\Resources\{DefaultResource};
use App\Interfaces\Services\MailInterface;
use Illuminate\Support\Facades\Config;

class ForgotPasswordController extends Controller
{
    protected $service;

    public function __construct(MailInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Send an e-mail to recover password
     * @api {POST} /api/password/forgot
     * @param ForgotRequest $request
     * @return Resource json
     */
    public function forgot(ForgotRequest $request)
    {
        try {
            $email = $request->email;
            $token = $request->token;

            $baseUrl = Config::get('linking.password.url');
            $url = "{$baseUrl}{$token}&email={$email}";

            $this->service->sendAppForgotPassword($email, $url);

            $object = ['message' => 'O link para recuperação da senha foi enviado para seu endereço de e-mail.'];

            return new DefaultResource($object);
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }
}
