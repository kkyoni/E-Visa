<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\User;
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
use App\Mail\ReferFriend;
use App\EmailTemplates;

class ReferController extends Controller
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
        $this->pageLayout = 'front.pages.offer_discount.';
        $this->pageLayout1 = 'front.pages.offer_discount.';
        //View::share('tenure_values', Setting::where('code','interest_rate_duration')->first('value'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function offerdiscount(){
        return view($this->pageLayout1.'offer-discount');
    }

    public function refer(Request $request){
        $validatedData = Validator::make($request->all(),[
            'email'              => 'required',
            ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $user = User::where(['status'=>'active','id'=>Auth::user()->id])->first();
            $mailData['send_to'] = $request->email;
            $mailData['subject'] = "Refer And Friend";
            $mailData['body'] = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley";
            $mailData['link'] = Auth::user()->unique_id;
            $send = Mail::to($mailData['send_to'])->send(new ReferFriend($mailData['subject'],$mailData['send_to'],$mailData['body'],$mailData['link']));
            // if(!empty($send)){
                Notify::success('Send Refer To Mail');
                return redirect()->route('front.offerdiscount');
            // }
        }catch(\Exception $e){
            dd($e->getMessage());
        }
        
    }

}
