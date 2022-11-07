<?php

namespace App\Helpers;

use App\Constants\AuthConstants;
use App\Entities\AuthEntity;
use App\Entities\AuthTokenEntity;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
// use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client as OClient; 

class AuthHelper
{
    /**
     * Revoke user token
     * @param User $user
     * @return mixed
     */
    public static function revokeToken(?User $user = NULL): bool
    {
        $user = $user ?: request()->user();

        return $user->token()->revoke();
    }

    public static function createToken(
        User $user = NULL,
        ?string $password = NULL,
        ?bool $rememberMe = NULL
    ): AuthEntity {
        try {
            $user = $user ?: request()->user();

            $tokenResult = self::getTokenAndRefreshToken($user->email, $password);

            $expires_at = Carbon::now()->addSeconds($tokenResult["expires_in"]);
            if ($rememberMe) $expires_at = Carbon::now()->addWeeks(AuthConstants::NEXT_WEEK);

            $result = new AuthEntity(
                $user,
                $tokenResult["access_token"],
                $tokenResult["refresh_token"],
                $tokenResult["token_type"],
                $expires_at,
            );

            return $result;
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public static function refreshToken(string $refreshToken): array
    {
        $oClient = OClient::where('password_client', 1)->latest()->first();
        try{
            $response = Http::asForm()->post(env('OAUTH_URL'), [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'scope' => '*',
            ]);

            $tokenResult = json_decode((string) $response->getBody(), true);

            $expires_at = !empty($tokenResult["expires_in"]) ? Carbon::now()->addSeconds($tokenResult["expires_in"]) : null;

            $result = new AuthTokenEntity(
                $tokenResult["access_token"],
                $tokenResult["refresh_token"],
                $tokenResult["token_type"],
                $expires_at,
            );

            return $result->toArray();
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    private static function getTokenAndRefreshToken($email, $password): array { 
        try{
            $oClient = OClient::where('password_client', 1)->latest()->first();

            $response = Http::asForm()->post(env('OAUTH_URL'), [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ]);

            return json_decode((string) $response->getBody(), true);
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
