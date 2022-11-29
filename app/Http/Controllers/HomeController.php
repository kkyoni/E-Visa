<?php
namespace App\Http\Controllers;

use App\CardDetail;
use App\Country;
use App\CountryVisaFee;
use App\CountryWiseVisa;
use App\PrePostPayment;
use App\Transaction;
use App\User;
use App\UserQuesAns;
use App\VisaApplicant;
use App\VisaApplicantTemp;
use App\VisaApplication;
use App\VisaApplicationTemp;
use App\VisaType;
use App\VisaTypeEntry;
use Auth;
use DB;
use Mail;
use Illuminate\Http\Request;
use Event as Events;
use App\Setting;
use App\Cms;
use App\FromCountry;
use App\Faq;
use App\Feedback;
use App\Notifiction;
use App\ContactUs;
use App\Mail\InquiryEmail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use DataTables,Notify,Str,Storage;
use Socialite;
use Laravel\Socialite\Contracts\Provider;
use Yajra\DataTables\Html\Builder;
use function GuzzleHttp\Promise\all;
use \stdClass;

class HomeController extends Controller
{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authLayout = 'front.auth.';
        $this->pageLayout = 'front.pages.cms.';
        $this->frontLayout = 'front.pages.';
        $title = "";
        // $this->middleware('front');
    }

    public function index()
    {
        $title = "Home";
        $about_us = Cms::where('slug','about-us')->first();
        $feedback = Feedback::with('user_detail')->orderBy(DB::raw('RAND()'))->limit('5')->get();
        // $feedback = Feedback::with('user_detail')->orderBy('id', 'desc')->limit('5')->get();
        $countries = Country::get();
        $countryvisa = CountryWiseVisa::with('country')->where('favourite_status','1')->get();

//        if($_GET['ref']){
//            $ref = $_GET['ref'];
//            $user_id = Auth::User()->id;
//            if($ref && $user_id){
//                $visa_app = VisaApplication::where('user_id', $user_id)->orderBy('id', 'DESC')->first();
//                if(!empty($visa_app) && $visa_app->id){
//                    $check_trans = Transaction::where('order_id',$visa_app->id)->where('user_id',$user_id)->first();
//                    if(!empty($check_trans)){
//                        Transaction::where('id', $check_trans->id)->update([
//                            'order_id'              => $visa_app->id,
//                            'transaction_id'        => $ref,
//                            'payment_status'        => 'success',
//                            'user_id'               => $user_id,
//                        ]);
//                        $transaction = Transaction::where('order_id',$visa_app->id)->where('user_id',$user_id)->first();
//                    }else{
//                        $transaction = Transaction::create([
//                            'order_id'              => $visa_app->id,
//                            'transaction_id'        => $ref,
//                            'payment_status'        => 'success',
//                            'user_id'               => $user_id,
//                        ]);
//                    }
//                    Notify::success(' User Payment Successfully Done !!');
//                    return redirect()->route('front.index');
//                }
//            }
//        }

        return view('front.welcome',compact('about_us','title','countries','feedback','countryvisa'));
    }

    public function about(){
        $about_us = Cms::where('slug','about-us')->first();
        return view($this->pageLayout.'aboutus',compact('about_us'));
    }

    public function contact(){
        $country_list = Country::pluck('country','id');
        return view($this->pageLayout.'contactus',compact('country_list'));
    }

    public function privacypolicy(){
        $privacy = Cms::where('slug','privacy-policy')->first();
        return view($this->pageLayout.'privacy_policy',compact('privacy'));
    }

    public function paymentterms(){
        $payment = Cms::where('slug','payment-terms')->first();
        return view($this->pageLayout.'payment_terms',compact('payment'));
    }

    public function termscondition(){
        $terms = Cms::where('slug','terms-condition')->first();
        return view($this->pageLayout.'terms_condition',compact('terms'));
    }

    public function faq(){
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        $faq_list = Faq::where('status','active')->orderBy('order_by', 'asc')->get();
        return view($this->pageLayout.'faq',compact('faq_list','country_list','visa_types'));
    }

    public function faq_country(Request $request, $id){
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        $faq_list = Faq::where('country_id', $id)->where('status','active')->get();
        $country_id = $id;
        $visatypeid = '';
        return view($this->pageLayout.'faq',compact('faq_list','country_list','visa_types','visatypeid','country_id'));
    }

    public function faq_visatype(Request $request, $id){
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        $faq_list = Faq::where('visa_type_id', $id)->where('status','active')->get();
        $visatypeid = $id;
        $country_id = '';
        return view($this->pageLayout.'faq',compact('faq_list','country_list','visa_types','visatypeid','country_id'));
    }

    public function populardestinations(){
        $popular = Cms::where('slug','popular-destinations')->first();
        return view($this->pageLayout.'popular_destinations',compact('popular'));
    }


    public function ContactForm(Request $request) {
        $validator = Validator::make($request->all(),[
            'name'          => 'required',
            'email'         => 'required',
            'contact_no'    => 'required',
            'country'       => 'required',
            'message'       => 'required|max:255',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } try{
            $contact = ContactUs::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'contact_no'        => $request->contact_no,
                'country'           => $request->country,
                'message'           => $request->message
            ]);
            $country = Country::where('id',$request->get('country'))->first();
            $mailData['send_to'] = $request->get('email');
            $mailData['subject'] = 'Inquiry for project';
            $mailData['body'] = $request->get('message');
            $mailData['country'] = $country->country;
            $mailData['phone'] = $request->get('mobile_number');
            $mailData['email'] = $request->get('email');
            $mailData['name'] = $request->get('name');
            Mail::to($mailData['email'])->send(new InquiryEmail($mailData['subject'], $mailData['send_to'], $mailData['body'], $mailData['country'],$mailData['phone'],$mailData['email'],$mailData['name']));
            Notify::success('Inquiry Sent successfully !!');
            return redirect()->route('front.contact');
        }catch (\Exception $e){
            Notify::error($e->getMessage());
        }
    }
    public function logout() {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect()->route('front.index');
    }


    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderFacebookCallback()
    {
        $auth_user = Socialite::driver('facebook')->user();
        if(!empty($auth_user)) {
            $f_user = User::where('email', $auth_user->email)->first();
            if (!empty($f_user)) {
                Auth::login($f_user);
                Notify::success('Login with Facebook successfully !!');
                return redirect()->route('front.profile');
            } else {
                $user = User::create([
                    'name' => $auth_user->name,
                    'email' => $auth_user->email,
                    'password' => bcrypt('12345678'),
                    'user_type' => 'user',
                    'role_id' => '2',
                    'avatar_date' => date('Y-m-d'),
                    'avatar' => 'default.png',
                    'social_status' => 'facebook',
                ]);
                $noifiction = Notifiction::Create([
                    'user_id'              => $user->id,
                    'passport_expiry'      => 'active',
                    'profile_image_update' => 'active',
                    'visa_statua_update'   => 'active',
                ]);
                if (!empty($user)) {
                    Auth::login($user);
                    Notify::success('Login with Facebook successfully !!');
                    return redirect()->route('front.profile');
                }
            }
        }
    }


    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->first();
            if($finduser){
                Auth::login($finduser);
                Notify::success('Login with Google successfully !!');
                return redirect()->route('front.profile');
            }else{
                $user = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => bcrypt('12345678'),
                    'user_type' => 'user',
                    'role_id' => '2',
                    'avatar_date' => date('Y-m-d'),
                    'avatar' => 'default.png',
                    'social_status' => 'google',
                ]);
                $noifiction = Notifiction::Create([
                    'user_id'              => $user->id,
                    'passport_expiry'      => 'active',
                    'profile_image_update' => 'active',
                    'visa_statua_update'   => 'active',
                ]);
                Auth::login($user);
                Notify::success('Login with Google successfully !!');
                return redirect()->route('front.profile');
            }
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }

    public function no_visa(){
        $countries = Country::get();
        return view($this->frontLayout.'no_visa',compact('countries'));
    }

    public function checkvisa(Request $request){
        $details = CountryWiseVisa::with('country','visatype','visatypeentry','country_from')
            ->where('country_id',$request->destination_country)
            ->whereRaw("find_in_set($request->from_country,country_from_id)")
            ->first();

        $from_country='';
        if(!empty($details)){
            return response()->json([ 'result' => true]);
        }else{
            return response()->json([ 'result' => false ]);
        }
    }

    public function apply_now(){
        $inputs = array();
        $countries = Country::get();
        $visaentries = VisaTypeEntry::pluck('visa_type_entry','id');
        $nationality_countries = Country::pluck('country','id');
        // $visaentries = VisaTypeEntry::get();
        if(\Auth::check()){
            $user = Auth::user();
        }else{
            $user = array();
        }
        return view($this->frontLayout.'apply_now',compact('countries','user','visaentries','inputs','nationality_countries'));
    }

    public function apply_now_form(Request $request){

        // dd($request->all());
        $visa_entry_id = $request->visa_entry_id;
        $nationality_id = $request->nationality_id;
        $country_residence = $request->from_country_id;
        $nationality_countries = Country::pluck('country','id');
        $countries = Country::get();
        $visaentries = VisaTypeEntry::pluck('visa_type_entry','id');
        $inputs = $request->all();
        $visatype = CountryWiseVisa::with(['visatype','countryvisafee'])->where('id', $request->visa_detail_id)->first();
        $gov_fee_tex = Country::where('id',$country_residence)->first();
        $visaentry = VisaTypeEntry::where('id', $request->visa_entry_id)->first();
        if(\Auth::check()){
            $user = Auth::user();
        }else{
            $user = array();
        }
        // dd($visaentries);
        // return view($this->frontLayout.'apply_now',compact('visaentries','visa_entry_id'));
        return view($this->frontLayout.'apply_now',compact('countries','user','visaentries','inputs','visatype','visaentry','visa_entry_id','nationality_id','nationality_countries','country_residence','gov_fee_tex'));
    }

    public function track_order(){
        $visa_application = VisaApplication::with(['visa_applicants','UserDetail'])->where('id', 1)->first();
        dd($visa_application);
        if(!empty($visa_application)){
            $visa_application_applicant = $visa_application->visa_applicants;
            return view($this->frontLayout.'track_order', compact('visa_application','visa_application_applicant'));
        }else{
            $visa_application_applicant = array();
            return back();
        }

    }
     public function track_your_order(){
        return view($this->frontLayout.'track_your_order');
    }

    public function add_on(){
        $countries = Country::pluck('country', 'id');
        return view($this->frontLayout.'add_on', compact('countries'));
    }


    public function countrycost(){
        return view($this->frontLayout.'countrycost');
    }

    public function checkvisarequirement(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'destination'       => "required",
            'residence'         => "required",
            'nationality'       => "required",
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $faq_list = Faq::where('status','active')->orderBy('order_by', 'asc')->get();
            $visadetail = CountryWiseVisa::with(['CountryVisa'])
                ->where('country_wise_visas.country_id',$request->destination)
                ->where('from_countries.from_country_id', $request->nationality)
                ->join('from_countries','country_wise_visas.id','=','from_countries.country_visa_id')
                ->get();
            // dd($visadetail);
                // $country_to_tax = '';
                // $countryvisafee=array();
                $countries = Country::select('country','id')->get();
                $destination = $request->destination;
                $residence = $request->residence;
                $nationality = $request->nationality;
            if(sizeof($visadetail) > 0){
                return view($this->frontLayout.'countrycost', compact(['visadetail','destination','residence','countries','nationality','faq_list']));
                // return view($this->frontLayout.'countrycost', compact(['visadetail','countryvisafee','countries','country_to_tax','faq_list','destination','residence','nationality']));
            }
            $visadetail = array();
            Notify::error('No Requirement Found !!');
            return view($this->frontLayout.'countrycost', compact(['visadetail','destination','residence','countries','nationality','faq_list']));
            // return view($this->frontLayout.'countrycost', compact(['visadetail','countryvisafee','countries','country_to_tax','faq_list','destination','residence','nationality']));
            // return redirect()->route('front.index');
        }catch (\Exception $e){
            Notify::error($e->getMessage());
        }
    }

    // public function checkvisarequirement(Request $request){
    //     $validator = Validator::make($request->all(),[
    //         'destination'       => "required",
    //         'residence'         => "required",
    //         'nationality'       => "required",
    //     ]);
    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    //     try {
    //         $faq_list = Faq::where('status','active')->orderBy('order_by', 'asc')->get();
    //         // $visadetail = CountryWiseVisa::with(['country','visatype','visatypeentry','country_from','from_country','countryvisafee'])
    //         //     ->where('country_wise_visas.country_id',$request->destination)
    //         //     ->where('from_countries.from_country_id', $request->residence)
    //         //     ->join('from_countries','country_wise_visas.id','=','from_countries.country_visa_id')
    //         //     //->select('country_wise_visas.*','country_wise_visas.id AS country_visa_id','from_countries.*')
    //         //     ->first();
    //         //     // dd($request->destination,$request->residence);
    //         // // dd($visadetail);
    //         // if(empty($visadetail)){
    //         //     Notify::error('No Requirement Found !!');
    //         //     return redirect()->route('front.index');
    //         // }
    //         // $country_to_tax = '';
    //         // $countryvisafee=array();
    //         // $countries = Country::select('country','id')->get();
    //         // // dd($countries);
    //         // if(!empty($visadetail)){
    //         //     $countryvisafee = CountryVisaFee::with('visatypeentry')->where('country_visa_id', $visadetail->country_visa_id)->get();
    //         //     // dd($countryvisafee);
    //         //     $country_to_tax = Country::where('id', $visadetail->country_id)->first()->service_tax_fee;
    //         //     $destination = $request->destination;
    //         //     $residence = $request->residence;
    //         //     $nationality = $request->nationality;
    //         //     if($visadetail->visatype->visa_type === 'On Arrival Visa'){
    //         //         return view($this->frontLayout.'no_visa',compact('countries','destination','residence','nationality','faq_list'));
    //         //     }else{
    //         //         return view($this->frontLayout.'countrycost', compact(['visadetail','countryvisafee','destination','residence','nationality','countries','country_to_tax','faq_list']));
    //         //     }
    //         // }
    //     }catch (\Exception $e){
    //         Notify::error($e->getMessage());
    //     }
    // }

    public function check_orderstatus(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'application_no'       => "sometimes",
            'mobile_email'         => "sometimes",
            'last_name'            => "sometimes",
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            if($request->application_no){
                $visa_application = VisaApplication::with(['visa_applicants','UserDetail'])->where('application_no', $request->application_no)->first();
            }else if($request->mobile_email && $request->last_name){
                $visa_application = VisaApplication::with(['visa_applicants','UserDetail'])
                                //->where('visa_applicants.last_name', $request->last_name)
                                ->where('email', $request->mobile_email)
                                //->orWhere('visa_applications.whatapp_number', $request->mobile_email)
                                ->first();
            }
            // dd($visa_application);
            if(!empty($visa_application)){
                $visa_application_applicant = $visa_application->visa_applicants;
                return view($this->frontLayout.'track_order', compact('visa_application','visa_application_applicant'));
            }else{
                $visa_application_applicant = array();
                return back();
            }
        }catch (\Exception $e){
            Notify::error($e->getMessage());
        }
    }

    public function cost_calculate(){
        $countries = Country::select('country','id')->get();
        $visaentries = VisaTypeEntry::get();
        return view($this->frontLayout.'cost_calculate', compact('countries','visaentries'));
    }

    public function visa_cost_calculate(Request $request){
        $details = CountryWiseVisa::with('country','visatype','visatypeentry','country_from')
            ->where('from_countries.from_country_id', $request->nationality)
            ->where('country_wise_visas.country_id', $request->travelling_to)
            //->where('country_visa_fees.processing_time', $request->processing_time)
            ->where('country_visa_fees.visa_type_entry_id', $request->visa_entry)
            ->join('from_countries', 'from_countries.country_visa_id','=','country_wise_visas.id')
            ->join('country_visa_fees', 'country_visa_fees.country_visa_id','=','country_wise_visas.id')
            ->get();

            if(sizeof($details) > 0){
                if($details[0]['country']->service_tax_fee != "0"){
                    $from_country='';
                    if(!empty($details) && $details->count()){
                        return response()->json([ 'result' => $details, 'status'=>'success']);
                    }else{
                        return response()->json([ 'status'=>'error' ]);
                    }
                } else {
                    return response()->json([ 'status'=>'error' ]);
                }
            } else {
                return response()->json([ 'status'=>'error' ]);
            }
            
            // if($details->country){

            // }
        // dd($details);
        // $from_country='';
        // if(!empty($details) && $details->count()){
        //     return response()->json([ 'result' => $details, 'status'=>'success']);
        // }else{
        //     return response()->json([ 'status'=>'error' ]);
        // }
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
                    'email'             => @\Illuminate\Support\Facades\Auth::User()->email,
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
                    'visa_entry_id'                 => @$request->visa_entry_id,
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
                $checkemail = User::where('email', $request->email)->first();
                if(!empty($checkemail)){
                    Notify::error('Email Id Already Exist !!');
                    return redirect()->back()->withInput();
                }

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
                    'visa_entry_id'             => @$request->visa_entry_id,
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
                            $applicants = VisaApplicantTemp::create([
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
        // dd($questions);
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

    public function sign_up($application_id){

        if($application_id){
            $email = VisaApplicationTemp::where('id', $application_id)->first()->email;
            return view($this->frontLayout.'sign_up', compact('email', 'application_id'));
        }else{
            Notify::error('Visa Application not found');
            return back();
        }
    }

    public function user_sign_up(Request $request){
        $validator = Validator::make($request->all(),[
            'email'               => 'required|email|unique:users,email',
            'password'            => 'required|min:6',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $n = explode("@",@$request->email);
            $name = $n[0];
            $user = User::create([
                'email'             => @$request->email,
                'password'          => bcrypt(@$request->password),
                'user_type'         => 'user',
                'avatar'            => 'default.png',
                'status'            => 'active',
                'role_id'           => '2',
                'name'              => $name,
            ]);
            if($user){
                Auth::login($user);
                if(Auth::check()){
                    $visaapplicationtemp = VisaApplicationTemp::with('visa_applicant_temp')->where('id', $request->application_id)->where('app_status', 'pending')->first();

                    if(!empty($visaapplicationtemp)){
                        $application = VisaApplication::create([
                            'email'             => @$visaapplicationtemp->email,
                            'whatapp_number'    => @$visaapplicationtemp->whatapp_number,
                            'arrival_date'      => @$visaapplicationtemp->arrival_date,
                            'departure_date'    => @$visaapplicationtemp->departure_date,
                            'service_type'      => @$visaapplicationtemp->service_type,
                            'total_price'       => @$visaapplicationtemp->total_price,
                            'gov_fee'           => @$visaapplicationtemp->gov_fee,
                            'tax'               => @$visaapplicationtemp->tax,
                            'user_id'           => Auth::User()->id,
                            'application_no'    => rand(1000000,100000000),

                            'visa_type_id'                  => @$visaapplicationtemp->visa_type_id,
                            'visa_entry_id'                 => @$visaapplicationtemp->visa_entry_id,
                            'from_country_id'               => @$visaapplicationtemp->from_country_id,
                            'destination_country_id'        => @$visaapplicationtemp->destination_country_id,
                        ]);

                        if(!empty($application)){
                            if(isset($visaapplicationtemp->visa_applicant_temp)){
                                foreach ($visaapplicationtemp->visa_applicant_temp as $key => $value){

                                    $applicants = VisaApplicant::create([
                                        'application_id'            => @$application->id,
                                        'first_name'                => @$value->first_name,
                                        'last_name'                 => @$value->last_name,
                                        'gender'                    => @$value->gender,
                                        'nationality'               => @$value->nationality,
                                        'birthdate'                 => @$value->birthdate,
                                        'birth_country'             => @$value->birth_country,
                                        'resident_country'          => @$value->resident_country,
                                        'passport_number'           => @$value->passport_number,
                                        'passport_issue_date'       => @$value->passport_issue_date,
                                        'passport_expiry_date'      => @$value->passport_expiry_date,
                                        'visa_entry_id'             => @$value->visa_entry_id,
                                        'passport_image'            => @$value->passport_image,
                                        'applicant_image'           => @$value->applicant_image,
                                    ]);
                                }
                            }
                        }
                    }
                    UserQuesAns::where('application_id', @$application->id)->update([ 'user_id' => Auth::User()->id ]);
                }

                Notify::success('User Sign Up Successful !!');
                return redirect()->route('front.payment', @$application->id);
            }else{
                return back();
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

            Transaction::create([
                'order_id'              => $request->application_id,
                'transaction_id'        => rand(1000000000,100000000000),
                'payment_status'        => 'success',
                'user_id'               => \Illuminate\Support\Facades\Auth::User()->id,
            ]);
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
        // $order->merchantAttributes->redirectUrl = 'https://urgentevisa.aistechnolabs.xyz';
        $order->merchantAttributes->redirectUrl = $request->root();
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
                Notify::success(' User Payment Successfully Done !!');
                return redirect()->route('front.index');
            }
        }
    }

}
