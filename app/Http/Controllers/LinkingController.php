<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Linking\ResetPasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Jenssegers\Agent\Agent;

class LinkingController extends Controller
{
    /**
     * Returns password reset page or screen on app
     * @api {GET} /password/reset
     * @param IndexRequest $request
     * @return RedirectResponse
     */
    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $agent = new Agent();
        $token = $request->token;
        $email = $request->email;
        
        if ($agent->isDesktop()) {
            $baseUrl = Config::get('linking.password.web_url');
            $url = "{$baseUrl}{$token}?email={$email}";
        } else {
            $baseUrl = Config::get('linking.password.scheme');
            $url = "{$baseUrl}{$token}&&email={$email}";
        }
  
        return redirect($url);
    }    
}

