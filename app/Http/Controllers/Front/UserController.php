<?php

namespace App\Http\Controllers\Front;

use App\Blog;
use App\CardDetail;
use App\Country;
use App\Notifiction;
use App\Http\Controllers\Controller;
use App\PrePostPayment;
use App\Transaction;
use App\User;
use App\UserQuesAns;
use App\VisaApplicant;
use App\VisaApplication;
use App\VisaApplicationTemp;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Validator,Str,Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use Mail;
use \stdClass;

class UserController extends Controller
{
    protected $authLayout = '';
    protected $pageLayout = '';
    protected $frontLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authLayout = 'front.auth.';
        $this->pageLayout = 'front.pages.user.';
        $this->frontLayout = 'front.pages.';

        //View::share('tenure_values', Setting::where('code','interest_rate_duration')->first('value'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function forgot_pwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);
        if ($validator->fails()){
            return response()->json(['status'   => 'error','message'  => $validator->messages()->first()]);
        }
        try{
            $user = User::where(['email'=>$request->email])->first();
            if(!$user){
                Notify::error('User Not Found.');
                return redirect()->route('front.index');
            } else {
                $password = Str::random(8);
                $mailData['mail_to']   = $user->email;
                $mailData['to_name']   = $user->first_name;
                $mailData['mail_from']   = 'admin@admin.com';
                $mailData['from_title']  = 'Reset Password';
                $mailData['subject']     = 'Reset Password';
                $data = [
                    'data' => $mailData,
                    'username'=>$user->first_name,
                    'password'=>$password
                ];
                Mail::send('emails.verify', $data, function($message) use($mailData) {
                    $message->subject($mailData['subject']);
                    $message->from($mailData['mail_from'],$mailData['from_title']);
                    $message->to($mailData['mail_to'],$mailData['to_name']);
                });
                if(Mail::failures()) {
                    return response()->json(['status'=>'error','message'=>'Mail failed']);
                }
                $user->password = \Hash::make($password);
//                $user->link_code = \Hash::make($password);
                $user->save();
                Notify::success('New Password has been sent to Email Id');
                return redirect()->route('front.index');
            }
        }catch(Exception $e){
            return response()->json(['status'    => 'error','message'   => $e->getMessage()]);
        }
    }


    public function logout() {
        Auth::logout();
        Notify::success('logout User.');
        return redirect()->route('front.index');
    }

    public function profile(){
        if(\Auth::check()){
            $user = User::where(['status'=>'active','id'=>Auth::user()->id])->first();
            $notification = Notifiction::where(['user_id'=>Auth::user()->id])->first();
            if(empty($user)){
                Notify::error('User not found.');
                return redirect()->to('front/dashboard');
            }
            return view($this->pageLayout.'updateprofile',compact('user','notification'));
        }else{
            return redirect()->route('front.index');
        }
    }

    public function notification(Request $request){
        $notifiction_list = Notifiction::where('user_id',Auth::user()->id)->first();
        if(!empty($notifiction_list)){
            Notifiction::where('id',$notifiction_list->id)->update([
                'passport_expiry'    => $request->passport_expiry,
                'profile_image_update'      => $request->profile_image_update,
                'visa_statua_update'  => $request->visa_statua_update,
            ]);
            Notify::success('Profile updated successfully !!');
        }else{
            Notifiction::create([
                'user_id'    => Auth::user()->id,
                'passport_expiry'    => $request->passport_expiry,
                'profile_image_update'      => $request->profile_image_update,
                'visa_statua_update'  => $request->visa_statua_update,
            ]);
            Notify::success('Profile Created Successfully.');
        }
        return redirect()->back();
    }

    public function updateProfileDetail(Request $request){
        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'mobile'  => 'required',
            'wpmobile'  => 'required',
            'passport'  => 'required',
            'email' => 'unique:users,email,'.Auth::user()->id,

            'user_photo'        => 'nullable|mimes:jpeg,png,jpg,gif',
            'passport_photo'    => 'nullable|mimes:jpeg,png,jpg,gif',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // if ($validator->fails()){
        //     return response()->json(['status'   => 'error','message'  => $validator->messages()->first()]);
        // }
        try{

            $allowedfileExtension=['pdf','jpg','png'];
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('avatar', $file,$filename);
                $avatar_date = date('Y-m-d');
            }else{
                $userDetail=User::where('id',Auth::user()->id)->first()->avatar;
                $filename = $userDetail;
            }
            $allowedfileExtension=['pdf','jpg','png'];

            
            if($request->hasFile('user_photo')){
                $file = $request->file('user_photo');
                $extension = $file->getClientOriginalExtension();
                $userfile = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('avatar', $file,$userfile);
            } else{
                $user_photo = User::where('id',Auth::user()->id)->first()->user_photo;
                $userfile = $user_photo;
            }
            // // dd($userfile);

            $allowedfileExtension=['pdf','jpg','png'];
            
            // dd($passport_photo);
            if($request->hasFile('passport_photo')){
                $file = $request->file('passport_photo');
                $extension = $file->getClientOriginalExtension();
                $passportfile = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('avatar', $file,$passportfile);
            }else{
                $passport_photo = User::where('id',Auth::user()->id)->first()->passport_photo;
                $passportfile = $passport_photo;
            }

            User::where('id',Auth::user()->id)->update([
                'avatar'                => @$filename,
                'name'                  => @$request->name,
                'mobile'                => @$request->mobile,
                'wpmobile'              => @$request->wpmobile,
                'passport'              => @$request->passport,
                'passport_issue_date'   => @$request->passport_issue_date,
                'passport_expiry_date'  => @$request->passport_expiry_date,
                'email'                 => @$request->email,
                'avatar_date'           => @$avatar_date,
                'user_photo'            => @$userfile,
                'passport_photo'        => @$passportfile,
            ]);
            Notify::success('Profile updated successfully !!');
            return redirect()->route('front.profile');
        }catch(\Exception $e){
            Notify::error($e->getMessage());
        }
    }

    public function updatePassword(Request $request){
        $validatedData = $request->validate([
            'old_password'          => 'required',
            'password'              => 'required|regex:/((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{8})/|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
        ]);
        if (\Hash::check($request->get('old_password'),auth()->user()->password) === false) {
            // The passwords matches
            Notify::error('Your current password does not matches with the password you provided. Please try again.');
            return redirect()->back();
        }
        $user = auth()->user();
        $user->password =\Hash::make($request->get('password'));
        $user->save();
        Notify::success('Password updated successfully !');
        return redirect()->back();
    }

    public function applynowform(Request $request) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(),[
            'email'                     => 'required',
            'whatapp_number'            => 'required',
            'arrival_date'              => 'required',
            'departure_date'            => 'required',
            'first_name'                => 'required',
            'last_name'                 => 'required',
            'gender'                    => 'required',
            'nationality'               => 'required',
            'resident_country'          => 'required',
            'passport_number'           => 'required',
            'passport_issue_date'       => 'required',
            'passport_expiry_date'      => 'required',
            'visa_entry_id'             => 'required',
//            'passport_image'            => 'required',
//            'applicant_image'           => 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } try{
            if(\Auth::check() == true){
                $application = VisaApplication::create([
                    'email'             => @Auth::User()->email,
                    'whatapp_number'    => @$request->whatapp_number,
                    'arrival_date'      => @$request->arrival_date,
                    'departure_date'    => @$request->departure_date,
                    'service_type'      => @$request->service_type,
                    'total_price'       => @$request->total_price,
                    'gov_fee'           => @$request->regular_gov_fee,
                    'tax'               => @$request->tax,
                    'user_id'           => Auth::User()->id,
                    'application_no'    => rand(1000000,100000000),

                    'visa_type_id'                  => @$request->visa_type_id,
                    'from_country_id'               => @$request->from_country_id,
                    'destination_country_id'        => @$request->destination_country_id,
                ]);

                if(!empty($application)){
                    if(isset($request->first_name)){
                        foreach ($request->first_name as $key => $name){
                            $filepassport = $fileapplicant ='';
                            if($request->hasFile('passport_image')){
                                $file = $request->file('passport_image')[$key];
                                $extension = $file->getClientOriginalExtension();
                                $filepassport = Str::random(10).'.'.$extension;
                                Storage::disk('public')->putFileAs('passport_images', $file,$filepassport);
                            }
                            if($request->hasFile('applicant_image')){
                                $file = $request->file('applicant_image')[$key];
                                $extension = $file->getClientOriginalExtension();
                                $fileapplicant = Str::random(10).'.'.$extension;
                                Storage::disk('public')->putFileAs('applicant_images', $file,$fileapplicant);
                            }
                            $applicants = VisaApplicant::create([
                                'application_id'            => @$application->id,
                                'first_name'                => @$name,
                                'last_name'                 => @$request->last_name[$key],
                                'gender'                    => @$request->gender[$key],
                                'nationality'               => @$request->nationality[$key],
                                'birthdate'                 => @$request->birthdate[$key],
                                'birth_country'             => @$request->birth_country[$key],
                                'resident_country'          => @$request->resident_country[$key],
                                'passport_number'           => @$request->passport_number[$key],
                                'passport_issue_date'       => @$request->passport_issue_date[$key],
                                'passport_expiry_date'      => @$request->passport_expiry_date[$key],
                                'visa_entry_id'             => @$request->visa_entry_id[$key],
                                'passport_image'            => @$filepassport,
                                'applicant_image'           => @$fileapplicant,
                            ]);
                        }
                    }
                }
            }else{
                $application = VisaApplicationTemp::create([
                    'email'                     => @$request->email,
                    'whatapp_number'            => @$request->whatapp_number,
                    'arrival_date'              => @$request->arrival_date,
                    'departure_date'            => @$request->departure_date,
                    'service_type'              => @$request->service_type,
                    'total_price'               => @$request->total_price,
                    'gov_fee'                   => @$request->regular_gov_fee,
                    'tax'                       => @$request->tax,
                    'visa_type_id'              => @$request->visa_type_id,
                    'from_country_id'           => @$request->from_country_id,
                    'destination_country_id'    => @$request->destination_country_id,
                ]);

                if(!empty($application)){
                    if(isset($request->first_name)){
                        foreach ($request->first_name as $key => $name){
                            $filepassport = $fileapplicant ='';
                            if($request->hasFile('passport_image')){
                                $file = $request->file('passport_image')[$key];
                                $extension = $file->getClientOriginalExtension();
                                $filepassport = Str::random(10).'.'.$extension;
                                Storage::disk('public')->putFileAs('passport_images', $file,$filepassport);
                            }
                            if($request->hasFile('applicant_image')){
                                $file = $request->file('applicant_image')[$key];
                                $extension = $file->getClientOriginalExtension();
                                $fileapplicant = Str::random(10).'.'.$extension;
                                Storage::disk('public')->putFileAs('applicant_images', $file,$fileapplicant);
                            }
                            $applicants = VisaApplicant::create([
                                'application_id'            => @$application->id,
                                'first_name'                => @$name,
                                'last_name'                 => @$request->last_name[$key],
                                'gender'                    => @$request->gender[$key],
                                'nationality'               => @$request->nationality[$key],
                                'birthdate'                 => @$request->birthdate[$key],
                                'birth_country'             => @$request->birth_country[$key],
                                'resident_country'          => @$request->resident_country[$key],
                                'passport_number'           => @$request->passport_number[$key],
                                'passport_issue_date'       => @$request->passport_issue_date[$key],
                                'passport_expiry_date'      => @$request->passport_expiry_date[$key],
                                'visa_entry_id'             => @$request->visa_entry_id[$key],
                                'passport_image'            => @$filepassport,
                                'applicant_image'           => @$fileapplicant,
                            ]);
                        }
                    }
                }
            }

            Notify::success('Visa Application Created Successfully !!');
            $questions = PrePostPayment::where('payment_status', 'post')->get();
            $application_id = @$application->id;
            //return view($this->frontLayout.'question-form', compact('questions','application_id'));
            return redirect()->route('front.questionform',$application_id);
        }catch (\Exception $e){
            Notify::error($e->getMessage());
        }
    }

    public function questionform($application_id=2){
        $questions = PrePostPayment::where('payment_status', 'post')->get();
        $application_id = @$application_id;
        return view($this->frontLayout.'question-form', compact('questions','application_id'));
    }

     public function questionformpre($application_id=2){
        $questions = PrePostPayment::where('payment_status', 'pre')->get();
        $application_id = @$application_id;
        return view($this->frontLayout.'question-form-pre', compact('questions','application_id'));
    }

    public function submituserans(Request $request){
        $validator = Validator::make($request->all(),[
            'user_answer'       => "required",
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            if(isset($request->question_id)){
                foreach ($request->question_id as $key => $que){
                    $userans = UserQuesAns::create([
                        'question_id'       => $que,
                        'answer'            => $request->user_answer[$key],
                        'status'            => 'active',
                        'application_id'    => $request->application_id,
                        'user_id'           => @Auth::User()->id,
                    ]);

                    if((int)$key === (int)$request->sub_que_index){
                        UserQuesAns::where('id', $userans->id)->update([
                            'sub_que'     => $request->sub_que[0],
                            'sub_ans'     => $request->sub_ans[0],
                            'last_que'    => $request->last_que,
                            'last_ans'    => $request->last_ans,
                        ]);
                    }
                }
            }
            Notify::success(' User Question with Answer Submitted Successfully !!');
            //return view($this->frontLayout.'payment', compact(''));
            $application_id = $request->application_id;

            if(\Auth::check() == true){
                return redirect()->route('front.payment', $application_id);
            }else{
                return redirect()->route('front.sign_up', $application_id);
            }


        }catch (\Exception $e){
            Notify::error($e->getMessage());
        }

    }

    public function payment($application_id){
        return view($this->frontLayout.'payment', compact('application_id'));
    }


    public function submit_payment(Request $request){
        $validator = Validator::make($request->all(),[
            'card_type'         => "nullable",
            'card_number'       => "nullable",
            'card_name'         => "nullable",
            'month'             => "nullable",
            'year'              => "nullable",
            'cvv'               => "nullable",
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $checkcarddetail = CardDetail::where('user_id', Auth::User()->id)->where('card_number', $request->card_number)->first();
            if(empty($checkcarddetail)){
                CardDetail::create([
                    'user_id'               =>  Auth::User()->id,
                    'card_type'             =>  $request->card_type,
                    'card_number'           =>  $request->card_number,
                    'card_holder_name'      =>  $request->card_name,
                    'card_expiry_month'     =>  $request->month,
                    'card_expiry_year'      =>  $request->year,
                    'cvv'                   =>  $request->cvv,
                ]);
            }
            $makepayment = $this->make_payment();
            Notify::success(' User Payment Successfully Done !!');
            $application_id = $request->application_id;
            $application_no = VisaApplication::where('id', $application_id)->first()->application_no;
            return redirect()->route('front.index');
        }catch (\Exception $e){
            Notify::error($e->getMessage());
        }

    }

    public function make_payment(){
        $outletRef   = env('NGENIUS_OUTLET_REF');
        $apikey      = env('NGENIUS_API_KEY');

        $idServiceURL  = "https://identity-uat.ngenius-payments.com/auth/realms/ni/protocol/openid-connect/token";
        $txnServiceURL = "https://api-gateway-uat.ngenius-payments.com/transactions/outlets/".$outletRef."/orders";

        $tokenHeaders  = array("Authorization: Basic ".$apikey, "Content-Type: application/x-www-form-urlencoded");
        $tokenResponse = $this->invokeCurlRequest("POST", $idServiceURL, $tokenHeaders, http_build_query(array('grant_type' => 'client_credentials')));
        $tokenResponse = json_decode($tokenResponse);

        $access_token = $tokenResponse->access_token;

        $order = new stdClass;

        $order->action = "AUTH";
        $order->amount = new stdClass;
        $order->amount->currencyCode = "AED";
        $order->amount->value = 1.00;
//        $order->language = "en";
//        $order->merchantOrderReference = time();
//        $order->emailAddress = 'coustomer@gmail.com';
//        $order->billingAddress = new stdClass;
//        $order->billingAddress->firstName = "swapnil";
//        $order->billingAddress->lastName = 'nath';

        $order->merchantAttributes = new stdClass;
        $order->merchantAttributes->redirectUrl = 'https://urgentevisa.aistechnolabs.xyz/success_page';
//        $order->merchantAttributes->redirectUrl = 'https://webhook.site/4e4546dc-c73f-4ab4-8252-b5fd0e795bce';

        $order->payment = new stdClass;
        $order->payment->pan                = '4012001037141112';
        $order->payment->expiry             = '02/2022';
        $order->payment->cvv                = '123';
        $order->payment->cardholderName     = 'swapnil';

        $order = json_encode($order);

        $orderCreateHeaders  = array("Authorization: Bearer ".$access_token, "Content-Type: application/vnd.ni-payment.v2+json", "Accept: application/vnd.ni-payment.v2+json");

        $orderCreateResponse = $this->invokeCurlRequest("POST", $txnServiceURL, $orderCreateHeaders, $order);

        $orderCreateResponse = json_decode($orderCreateResponse);
        $paymentLink         = $orderCreateResponse->_links->payment->href;
        $orderReference      = $orderCreateResponse->reference;

        header("Location: ".$paymentLink);
    }

    function invokeCurlRequest($type, $url, $headers, $post) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($type == "POST") {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        return $server_output;
    }

    public function success_page(){
        $ref = $_GET['ref'];
        $user_id = Auth::User()->id;
        if($ref && $user_id){
            $visa_app = VisaApplication::where('user_id', $user_id)->orderBy('id', 'DESC')->first();
            if(!empty($visa_app) && $visa_app->id){
                $check_trans = Transaction::where('order_id',$visa_app->id)->where('user_id',$user_id)->first();
                if(!empty($check_trans)){
                    Transaction::where('id', $check_trans->id)->update([
                        'order_id'              => $visa_app->id,
                        'transaction_id'        => $ref,
                        'payment_status'        => 'success',
                        'user_id'               => $user_id,
                    ]);
                    $transaction = Transaction::where('order_id',$visa_app->id)->where('user_id',$user_id)->first();
                }else{
                    $transaction = Transaction::create([
                        'order_id'              => $visa_app->id,
                        'transaction_id'        => $ref,
                        'payment_status'        => 'success',
                        'user_id'               => $user_id,
                    ]);
                }
                Notify::success(' User Payment Successfully Done for Network Payment !!');
                return redirect()->route('front.index');
            }
        }
    }
}
