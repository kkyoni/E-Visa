<?php

namespace App\Http\Controllers\Admin\Auth;


//use Auth;
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
    protected $redirectTo = '/admin/dashboard';
    protected $authLayout = 'admin.auth.';
    public function __construct()
    {
     $this->middleware('guest')->except('logout');
   }
   public function showLoginForm()
   {
    return view($this->authLayout.'login');
  }
  public function login(Request $request)
  {
    if (Auth::attempt([
      'email'     => $request->get('email'),
      'password'  => $request->get('password'),
      'status'    => 'active',
      ]))
    {
      if(Auth::user()->user_type == 'superadmin' || Auth::user()->user_type == "bo_user"){
       Notify::success('Welcome to Admin Panel.');
       return redirect()->route('admin.dashboard');
     }else{
       Auth::logout();
       Notify::error('User not found !!');
       return redirect()->route('admin.login');
     }
   }
   else
   {
    return $this->sendFailedLoginResponse($request, 'auth.failed_status');
  }
}

public function logout()
{
  Auth::logout();
  return redirect()->route('admin.login');
}
}
