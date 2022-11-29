<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\URL;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share('pageTitle','Login');
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('front.auth.login');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('front.home');
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $request->session()->put('login_error', trans('auth.failed'));
        throw ValidationException::withMessages(
            [
                'login_error' => [trans('auth.failed')],
            ]
        );
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login'    => 'required',
            'password' => 'required',
        ],[
            'login.required' => 'Username is required'
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';
        $request->merge([
            $login_type => $request->input('login')
        ]);
        $validator->after(function($validator) use ($request,$login_type){
            if($request->get('email') !== null && $login_type === 'email'){
               $getValidFrontUser = User::where('email',$request->get('email'))->where('role','user')->first();
               if(empty($getValidFrontUser)){
                   $validator->errors()->add('login', 'This email address does not have authorization.');
               }
            }
        });
        if ($validator->fails()) {
            return redirect()->route('front.login')->withInput()->withErrors($validator);
        }
        $userExist = User::where('role','user')
                        ->where('isActive','0')
                        ->orWhere('username',$request->input('login'))
                        ->orWhere('email',$request->input('login'))
                        ->first();
        if($userExist !== null && in_array($userExist->role,['web_master','super_admin'])){
            return redirect()->route('front.login')
                ->withInput()
                ->withErrors([
                    'login' => 'Email address is unauthorized.'
                ]);
        }
        if($userExist !== null && Auth::attempt($request->only($login_type, 'password'))){
           if(Auth::user()->email_verified_at === null ){
               Auth::logout();
               Session::flush();
               return redirect()->route('front.login')
                   ->withInput()
                   ->withErrors([
                       'login' => 'Email address is not verified.'
                   ]);
           }elseif (Auth::user()->isActive == '1'){
               Auth::logout();
               Session::flush();
               return redirect()->route('front.login')
                   ->withInput()
                   ->withErrors([
                       'login' => 'This User has been blocked.'
                   ]);
           }else{
               $this->logLoginDetails(Auth::user());
               return redirect()->route('front.profile.view');
           }
        }
        return redirect()->back()
            ->withInput()
            ->withErrors([
                'login' => 'These credentials do not match our records.'
            ]);
    }
}
