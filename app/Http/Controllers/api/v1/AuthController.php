<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticatedRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\UpdateRequest;
use App\Http\Resources\DefaultResource;
use App\Interfaces\Services\AuthInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected $service;

    public function __construct(AuthInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Create user
     * @api {POST} /api/v1/publics/auth/register
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->service->firstOrCreate($request->inputs);
        $object = $this->service->createToken($user, $request->extras['original_password']);

        return (new DefaultResource($object))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Login user and create token
     * @api {POST} /api/v1/publics/auth/login
     * @param LoginRequest $request
     * @return DefaultResource
     */
    public function login(LoginRequest $request): DefaultResource
    {
        $object = $this->service->createToken(
            $request->user(),
            $request->password,
            $request->remember_me
        );

        return new DefaultResource($object);
    }

    /**
     * Logout user revoking its token
     * @api {GET} /api/v1/privates/auth/logout
     * @param LogoutRequest $request
     * @return JsonResponse
     */
    public function logout(LogoutRequest $request): DefaultResource
    {
        $this->service->revokeToken($request->user());
        $object = ['message' => 'User successfully signed out'];
        
        return new DefaultResource($object);
    }

    /**
     * Get the authenticated user
     * @api {GET} /api/v1/privates/auth/user
     * @param AuthenticatedRequest $request
     * @return DefaultResource
     */
    public function authenticated(AuthenticatedRequest $request): DefaultResource
    {
        $object = $request->user();

        return new DefaultResource($object);
    }

    /**
     * Update a specific item
     * @api {PUT} /api/v1/api/v1/publics/auth/user/{user}
     * @param UpdateRequest $request
     * @return DefaultResource
     */
    public function update(UpdateRequest $request): DefaultResource
    {
        $object = $this->service->update($request->user, $request->inputs);

        return new DefaultResource($object);
    }

    /**
     * Refresh user access token
     * @api {POST} /api/v1/api/v1/publics/auth/refreshtoken
     * @param LoginRequest $request
     * @return DefaultResource
     */
    public function refreshToken(Request $request): DefaultResource
    {
        $refresh_token = $request->header('Refreshtoken');
        $object = $this->service->refreshToken(
            $refresh_token
        );

        return new DefaultResource($object);
    }
}
