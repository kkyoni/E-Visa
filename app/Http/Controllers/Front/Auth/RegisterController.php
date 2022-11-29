<?php

namespace App\Http\Controllers\Front\Auth;

use App\Notifications\UserRegisteredSuccessfully;
use App\Setting;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/myProfile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        View::share('pageTitle','Sign-up');
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'f_name'        => ['required', 'string', 'max:255'],
            'l_name'        => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'mobile_number' => ['required', 'digits_between:10,15'],
            'interests'     => ['required'],
            'terms'         => ['required']
        ],[
            'f_name.required'           => 'First name is required',
            'l_name.required'           => 'Last name is required',
            'email.required'            => 'Email Address is required',
            'password.required'         => 'Password is required',
            'mobile_number.required'    => 'Mobile number is required',
            'interests.required'        => 'Please select at least one interest. ',
            'terms.required'            => 'Please accept terms and condition',
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function showRegistrationForm(){
        $termsAndConditions = Setting::where('code','terms_and_condition')->first();
        return view('front.auth.register',compact('termsAndConditions'));
    }
    /**
     * Register new account.
     *
     * @param Request $request
     * @return User
     */
    protected function register(Request $request)
    {
        /** @var User $user */
        $validatedData = Validator::make($request->all(), [
            'f_name'        => ['required', 'string', 'max:255'],
            'l_name'        => ['required', 'string', 'max:255'],
            'username'      => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8'],
            'mobile_number' => ['required', 'digits_between:10,15'],
            'interests'     => ['required'],
            'terms'         => ['required']
        ],[
            'f_name.required'           => 'First name is required',
            'l_name.required'           => 'Last name is required',
            'username.required'         => 'Username is required',
            'email.required'            => 'Email Address is required',
            'password.required'         => 'Password is required',
            'mobile_number.required'    => 'Mobile number is required',
            'mobile_number.digits_between'    => 'Mobile number must be 10 digits and less than 15',
            'interests.required'        => 'Please select at least one interest. ',
            'terms.required'            => 'Please accept terms and condition',
        ]);
        $validatedData->after(function ($validatedData) use ($request) {

        });
        if($validatedData->fails()){
            return response()->json([
                'status'   => 'error',
                'message'  => $validatedData->getMessageBag()
            ],400);
        }
        try {
            $user = User::create([
                'first_name'        => $request->get('f_name'),
                'last_name'         => $request->get('l_name'),
                'username'          => $request->get('username'),
                'mobile_number'     => $request->get('mobile_number'),
                'email'             => $request->get('email'),
                'password'          => Hash::make($request->get('password')),
                'role'              => 'user',
                'isAdmin'           => '0',
                'activation_code'   => Str::random(30).time(),
                'isActive'          => '0',
            ]);
            $user->interests()->sync($request->get('interests'));
            $user->notify(new UserRegisteredSuccessfully($user));
            return response()->json([
                'status'        => 'success',
                'title'         => 'Success!!',
                'message'       =>  'Successfully created a new account. Please check your email and activate your account.',
                'redirect_url'  => route('front.login')
            ]);
        }catch (\Exception $exception) {
            logger()->error($exception);
            return response()->json([
                'status'    => 'error',
                'message'   => 'Unable to create new user because '. $exception->getMessage()
            ]);
        }
    }
    /**
     * Activate the user with given activation code.
     * @param string $activationCode
     * @return string
     */
    public function activateUser(string $activationCode)
    {
        try {
            $user = User::where('activation_code', $activationCode)->first();
            if ($user === null) {
                return redirect()->route('front.register')->with([
                    'status'    => 'danger',
                    'message'   => 'The code does not exist for any user in our system.'
                ]);
            }else{
                $user->email_verified_at    = time();
                $user->save();
                return redirect()->route('front.login')->with([
                    'status'    => 'success',
                    'message'   => 'Your email id <strong>'.$user->email.'</strong> is registered. Please login into system.'
                ]);
            }
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->route('front.register')->with([
                'status'    => 'danger',
                'message'   => 'Whoops! something went wrong.'
            ]);
        }
    }
}
