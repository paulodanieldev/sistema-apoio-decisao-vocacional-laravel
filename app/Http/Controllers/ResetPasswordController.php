<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Password\ResetRequest;
use App\Http\Resources\{DefaultResource};
use App\Interfaces\Services\PasswordResetInterface;
use App\Jobs\SendResetEmailLink;

class ResetPasswordController extends Controller
{
    /**
     * @var PasswordResetInterface
     */
    private $service;

    /**
     * Constructor method
     * @param PasswordResetInterface $service
     * @param SendResetEmailLink $job
     */
    public function __construct(PasswordResetInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Resets the user password
     * @api {POST} /api/password/reset
     * @param ResetRequest $request
     * @return Resource json
     */
    public function reset(ResetRequest $request)
    {
        $this->service->updatePassword($request->user, $request->password, $request->remember_token);

        return new DefaultResource(["message" => "A senha foi alterada com sucesso"]);
    }
}
