<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;

class PasswordResetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    // Show Request password Page.
    public function showPasswordRest(){
        return view('front.auth.restPassword');
    }
    // Send email with rest password link to the user.
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            ]);

        $user = User::where(['email'=> $request->email,'status'=>'active'])->whereIn('user_type',['superadmin','Manager'])->first();

        if (!$user)
            return back()->with([
                'alert-type'   => 'danger',
                'message' => "We can't find a user with that e-mail address."
                ]);

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
            'email' => $user->email,
            'token' => str_random(60)
            ]
            );
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
                );
        return back()->with([
            'alert-type'   => 'success',
            'message' => 'We have e-mailed your password reset link!'
            ]);
    }
    // Show Reset Password page
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
        ->first();
        if (!$passwordReset)
            return back()->with([
                'alert-type'   => 'danger',
                'message' => 'This password reset token is invalid.'
                ]);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return back()->with([
                'alert-type'   => 'danger',
                'message' => 'This password reset token is invalid.'
                ]);
        }
        //return response()->json($passwordReset);
        return view('admin.auth.reset',compact('passwordReset'));
    }
    // Rest password
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            '_token' => 'required|string'
            ]);
        $passwordReset = PasswordReset::where([
            ['token', $request->_token],
            ['email', $request->email]
            ])->first();
//        dd($passwordReset);

        if (!$passwordReset){
            \Notify::error('This password reset token is invalid.');
            return back()->with([
                'alert-type'   => 'danger',
                'message'      => 'This password reset token is invalid.'
                ]);
        }
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user){
            \Notify::error('We can\'t find a user with that e-mail address.');
            return back()->with([
                'alert-type'   => 'danger',
                'message' => "We can't find a user with that e-mail address."
                ]);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        \Notify::success('Password reset successfully.');
        return redirect()->route('admin.login')->with([
            'alert-type'    => 'success',
            'message'       => "Password reset successfully."
            ]);
    }
}
