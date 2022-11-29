<?php

namespace App\Http\Controllers\Auth;


//use Auth;
use App\Cms;
use App\Country;
use App\Helpers\Helper;
use App\User;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    protected $redirectTo = '/';
    protected $authLayout = 'auth.';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $about_us = Cms::where('slug', 'About_Us')->first();
        $countries = Country::get();
        return view('front.welcome', compact('about_us','countries'));
    }

    public function login(Request $request)
    {
        if (\Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => 'active',
            ])) {
            // Updated this line
            if (Helper::auth() == 'User') {
                Notify::success('Welcome to User Panel.');
                return redirect()->route('front.index');
            } else {
                Auth::logout();
                Notify::error('User not found !!');
                return redirect()->route('front.login');
            }
        } else {
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.home');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
