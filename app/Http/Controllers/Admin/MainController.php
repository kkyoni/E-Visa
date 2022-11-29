<?php
namespace App\Http\Controllers\Admin;
use App\VisaApplicant;
use App\VisaApplication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User,App\Country,App\SiteSetting;
use Carbon\Carbon;
use App\Transaction;

class MainController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = 'admin.pages.';

    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.';
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input:
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(){
        return view('admin.auth.login');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for dashboard
    @input:
    @Output: display count data
    -------------------------------------------------------------------------------------------- */
    public function dashboard(){
        $total_superadmin = User::with('role')->whereHas('role',function ($q){
            return $q->where('name','=','Admin');
        })->orderBy('id','desc')->count();
        $total_user = User::with('role')->whereHas('role',function ($q){
            return $q->where('name','=','User');
        })->orderBy('id','desc')->count();
        $country = Country::count();
        $completed_app = Transaction::where('payment_status', 'success')->get()->count();
        $pending_app = Transaction::where('payment_status', 'pending')->get()->count();
        $rejected_app = Transaction::where('payment_status', 'reject')->get()->count();
        $cancelled_app = Transaction::where('payment_status', 'cancelled')->get()->count();
        return view('admin.pages.dashboard',compact('total_superadmin','country','total_user','pending_app','completed_app','rejected_app','cancelled_app'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Site Maintenance Mode Stop
    @input:
    @Output: Site Maintenance Mode Stop
    -------------------------------------------------------------------------------------------- */
    public function maintenancemode_down(){
        $id = "1";
        $data=['meta_value' => "1"];
        SiteSetting::where('id',$id)->update($data);
        return redirect()->route('admin.dashboard');
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for Site Maintenance Mode Start
    @input:
    @Output: Site Maintenance Mode Start
    -------------------------------------------------------------------------------------------- */
    public function maintenancemode_up(){
        $id = "1";
        $data=['meta_value'  => "0"];
        SiteSetting::where('id',$id)->update($data);
        return redirect()->route('admin.dashboard');
    }
}