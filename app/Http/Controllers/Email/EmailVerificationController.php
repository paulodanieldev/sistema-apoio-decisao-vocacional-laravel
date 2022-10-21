<?php

namespace App\Http\Controllers\Email;

use App\Constants\AccountTypePrefixConstants;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the email verify page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!empty(Auth::user())){
            if (!empty(Auth::user()->email_verified_at)) {
                return redirect()->route('user.dashboard');
            }else{
                return view('auth.verify');
            }
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        $userType = Auth::user()->account_type;

        switch ($userType) {
            case AccountTypePrefixConstants::ADMIN:
                return redirect()->route('admin.dashboard');
                break;
            case AccountTypePrefixConstants::USER:
                return redirect()->route('user.dashboard');
                break;
            default:
                return redirect()->route('login');
                break;
        }
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyNotification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
 
        return back()->with('message', 'Verification link sent!');
    }
}
