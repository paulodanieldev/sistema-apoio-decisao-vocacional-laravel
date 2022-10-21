<?php

namespace App\Http\Controllers;

use App\Constants\AccountTypePrefixConstants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
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
}
