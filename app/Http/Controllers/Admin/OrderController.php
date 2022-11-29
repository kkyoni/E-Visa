<?php
namespace App\Http\Controllers\Admin;
use App\VisaApplicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Validator,Str,Storage;
use Yajra\DataTables\Html\Builder;
use Auth;
use App\User;
use App\Cms;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;
use App\VisaApplication;

class OrderController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.order.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Order
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['order-list']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['order-edit']);
        $order = VisaApplication::with(['UserDetail'])->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($order->get())
            ->addIndexColumn()
            ->editColumn('name', function (VisaApplication $order) {
                return $order->UserDetail->name;
            })
            ->editColumn('email', function (VisaApplication $order) {
                return $order->UserDetail->email;
            })
            ->editColumn('status', function (VisaApplication $order) {
                if($order->status==='approved' || $order->status == 'completed') {
                    return '<button  data-value="1"   data-toggle="tooltip" title="'.ucfirst($order->status).'" class=" btn btn-success " >'.ucfirst($order->status).'</button>';
                }
                $status = '';
                $html = '<select class="form-control" id="changeStatus" data-id='.$order->id.'>';
                if($order->status=='pending') {
                    $html .='<option value="pending" selected>Pending</option>';
                    $html .='<option value="in-progress">In Progress</option>';
                    $html .='<option value="approved" >Approved</option>';
                    $html .='<option value="completed" >Completed</option>';
                    $html .='<option value="rejected" >Rejected</option>';
                    $html .='<option value="waiting_for_gov" >Waiting for Government</option>';
                }if($order->status=='in-progress'){
                    $html .='<option value="pending" >Pending</option>';
                    $html .='<option value="in-progress" selected>In Progress</option>';
                    $html .='<option value="approved" >Approved</option>';
                    $html .='<option value="completed" >Completed</option>';
                    $html .='<option value="rejected" >Rejected</option>';
                    $html .='<option value="waiting_for_gov" >Waiting for Government</option>';
                }if($order->status=='approved') {
                    $html .='<option value="pending" >Pending</option>';
                    $html .='<option value="in-progress">In Progress</option>';
                    $html .='<option value="approved" selected>Approved</option>';
                    $html .='<option value="completed" >Completed</option>';
                    $html .='<option value="rejected" >Rejected</option>';
                    $html .='<option value="waiting_for_gov" >Waiting for Government</option>';
                }if($order->status=='rejected') {
                    $html .='<option value="pending" >Pending</option>';
                    $html .='<option value="in-progress">In Progress</option>';
                    $html .='<option value="approved" >Approved</option>';
                    $html .='<option value="completed" >Completed</option>';
                    $html .='<option value="rejected" selected>Rejected</option>';
                    $html .='<option value="waiting_for_gov" >Waiting for Government</option>';
                }if($order->status=='waiting_for_gov') {
                    $html .='<option value="pending" >Pending</option>';
                    $html .='<option value="in-progress">In Progress</option>';
                    $html .='<option value="approved" >Approved</option>';
                    $html .='<option value="completed" >Completed</option>';
                    $html .='<option value="rejected" >Rejected</option>';
                    $html .='<option value="waiting_for_gov" selected>Waiting for Government</option>';
                }
                $html .= '</select>';
                return $html;
            })
            ->editColumn('action', function (VisaApplication $order){
                $action = '';
                $action .='<a class="btn btn-info btn-sm m-l-10 vieworder" data-id ="'.$order->id.'" data-toggle="modal" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                $action .='<a class="btn btn-warning btn-sm m-l-10 vieworderlisting" href="'.route('admin.order.order_show',[$order->id]).'" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                return $action;
            })
            ->rawColumns(['name','email','action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'3%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name'    => 'name', 'title' => 'Name','width'=>'5%'],
            ['data' => 'email', 'name'    => 'email', 'title' => 'Email','width'=>'7%'],
            ['data' => 'whatapp_number', 'name' => 'whatapp_number', 'title' => 'WhatsApp No','width'=>'8%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'12%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'8%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'searching'   => true,
        ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Order Status
    @input: Order
    @Output: Status Order Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $visaapplication = VisaApplication::where('id',$request->id)->first();
            if($visaapplication === null){
                return redirect()->back()->with([
                    'status'    => 'warning',
                    'title'     => 'Warning!!',
                    'message'   => 'Driver not found !!'
                ]);
            }else{
                VisaApplication::where('id',$request->id)->update(['status' => $request->status,]);
            }
            Notify::success('Driver status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Driver status updated successfully.'
            ]);
        }catch (Exception $e){
            return response()->json([
                'status'    => 'error',
                'title'     => 'Error!!',
                'message'   => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for show
    @input: id
    @Output: show Order
    -------------------------------------------------------------------------------------------- */
    public function show(Request $request){
        $visaapplication = VisaApplication::with(['visa_applicants','UserDetail','visatype','visatypeentry'])->where('id',$request->id)->first();
        return view($this->pageLayout.'show',compact('visaapplication'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Oredr show
    @input: id
    @Output: show Order
    -------------------------------------------------------------------------------------------- */
    public function order_show(Request $request, $id){
        $visaapplication = VisaApplication::with(['visa_applicants','UserDetail','visatype','visatypeentry'])->where('id',$request->id)->first();
        $app_status = array(
            'pending'               => 'Pending',
            'in-progress'           => 'In Progress',
            'approved'              => 'Approved',
            'completed'             => 'Completed',
            'waiting_for_gov'       => 'Waiting for Government',
        );
        return view($this->pageLayout.'order_show',compact('visaapplication','app_status'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Order Status
    @input: Order
    @Output: Status Order Change 
    -------------------------------------------------------------------------------------------- */
    public function change_visa_status(Request $request){
        try{
            $visa_applicants = VisaApplicant::where('id', $request->id)->first();
            if($visa_applicants === null){
                return redirect()->back()->with([
                    'status'    => 'warning',
                    'title'     => 'Warning!!',
                    'message'   => 'Visa Applicant not found !!'
                ]);
            }else{
                VisaApplicant::where('id',$request->id)->update(['status' => $request->status,]);
            }
            Notify::success('Visa Applicants Status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Visa Applicants Status updated successfully'
            ]);
        }catch (Exception $e){
            return response()->json([
                'status'    => 'error',
                'title'     => 'Error!!',
                'message'   => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Order Status
    @input: Order
    @Output: Status Order Change 
    -------------------------------------------------------------------------------------------- */
    public function rejectreason(Request $request){
        try{
            $visa_applicants = VisaApplicant::where('id', $request->id)->first();
            if($visa_applicants === null){
                Notify::error('Visa Applicants not found !!');
                return back();
            }else{
                VisaApplicant::where('id',$request->id)->update(['status' => 'rejected','reason' => $request->reason]);
            }
            Notify::success('Visa Applicants Status updated successfully !!');
            return back();
        }catch (Exception $e){
            return response()->json([
                'status'    => 'error',
                'title'     => 'Error!!',
                'message'   => $e->getMessage()
            ]);
        }
    }
}