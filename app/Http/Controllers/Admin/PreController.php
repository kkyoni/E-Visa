<?php
namespace App\Http\Controllers\Admin;
use App\AdminSubQuestion;
use App\VisaType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Validator,Str,Storage;
use Yajra\DataTables\Html\Builder;
use Auth;
use App\PrePostPayment;
use App\Country;
use App\PaymentCountry;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;

class PreController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.pre.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Pre
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['question-list','question-create','question-edit','question-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['question-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['question-edit']);
        $visatypeid = $country_id= '';
        $prepayment = PrePostPayment::where('payment_status','pre')->groupBy('u_id')->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($prepayment->get())
            ->addIndexColumn()
            ->editColumn('status', function (PrePostPayment $prepayment) {
                if ($prepayment->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('answer_type', function (PrePostPayment $prepayment) {
                return ucfirst($prepayment->answer_type);
            })
            ->addColumn('question', function(PrePostPayment $prepayment){
                return str_limit($prepayment->question, 30);
            })
            ->addColumn('answer_type', function(PrePostPayment $prepayment){
                return str_limit($prepayment->answer_type, 30);
            })
            ->editColumn('action', function (PrePostPayment $prepayment) use($permission_data) {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a class="btn btn-info btn-sm ml-2 mr-2 viewpre" data-id ="'.$prepayment->u_id.'" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>';
                    $action .='<a href='.route('admin.pre.edit',[$prepayment->u_id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                }
                if($permission_data['hasRemovePermission']){
                    $action .='<a class="btn btn-danger btn-sm m-l-1 deletepre" data-id ="'.$prepayment->u_id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
                }
                if($permission_data['hasUpdatePermission']){
                    if($prepayment->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$prepayment->u_id.'" title="Active"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$prepayment->u_id.'" title="Block"><i class="fa fa-lock"></i></a>';
                    }
                }
                return $action;
            })
            ->editColumn('u_id', function (PrePostPayment $prepayment) {
                if(!empty($prepayment->pre_country) && !empty($prepayment->pre_country->country)){
                    return $prepayment->pre_country->country->country;
                }else{
                    return '-';
                }
            })
            ->editColumn('visa_types', function (PrePostPayment $prepayment) {
                if(!empty($prepayment->pre_country) && !empty($prepayment->pre_country->pre_visa_list)){
                    return $prepayment->pre_country->pre_visa_list->visa_type;
                }else{
                    return '-';
                }
            })
            ->rawColumns(['action','status','u_id','question'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'u_id', 'name'    => 'u_id', 'title' => 'Country','width'=>'5%'],
            ['data' => 'question', 'name'    => 'question', 'title' => 'Question','width'=>'5%'],
            ['data' => 'answer_type', 'name' => 'answer_type', 'title' => 'Answer Type','width'=>'5%'],
            ['data' => 'visa_types', 'name' => 'visa_types', 'title' => 'Visa Type','width'=>'5%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'3%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'searching'   => true,
        ]);
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        return view($this->pageLayout.'index',compact('html','country_list','visa_types','visatypeid','country_id'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for create page view
    @input: Pre
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
        $userRole = Helper::checkPermission(['question-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        return view($this->pageLayout.'create',compact('country_list','visa_types'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Pre data
    @input: Pre
    @Output: store Pre data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'country_id'        => 'required',
            'visa'              => 'required',
            'question'          => 'required',
            'answer_type'       => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $paymentcountry=PaymentCountry::create([
                'country_id'        => @$request->get('country_id'),
                'visa'              => @$request->get('visa'),
            ]);
            if($request->answer_type === 'text' || $request->answer_type === 'datepicker'){
                $prepostpayment['u_id'] = $paymentcountry->id;
                $prepostpayment['question'] = $request->question;
                $prepostpayment['payment_status'] =  "pre";
                $prepostpayment['answer_type'] =  $request->answer_type;
                PrePostPayment::create($prepostpayment);
            }else if($request->answer_type === 'drop-down'){
                $proceed='';
                if(isset($request->proceed) && $request->proceed === '1'){
                    $proceed = $request->proceed;
                }else{
                    $proceed = '0';
                }
                $sub_proceed='';
                if(isset($request->sub_proceed) && $request->sub_proceed === '1'){
                    $sub_proceed = $request->sub_proceed;
                }else{
                    $sub_proceed = '0';
                }
                $prepostpayment['u_id'] = $paymentcountry->id;
                $prepostpayment['question'] = $request->question;
                $prepostpayment['payment_status'] =  "pre";
                $prepostpayment['answer_type'] =  $request->answer_type;
                $prepostpayment['add_droup'] =  $request->add_droup;
                $prepostpayment['note'] =  $request->note;
                $prepostpayment['proceed'] =  $proceed;
                $prepostpayment['tooltip'] =  $request->tooltip;
                $prepostpayment['sub_question']     =  $request->sub_question;
                $prepostpayment['sub_ans_type']     =  $request->sub_ans_type;
                $prepostpayment['sub_add_drop']     =  $request->sub_add_drop;
                $prepostpayment['sub_note']         =  $request->sub_note;
                $prepostpayment['sub_proceed']      =  $request->sub_proceed;
                $prepostpayment['sub_tooltip']      =  $request->sub_tooltip;
                $prepostpayment['last_question']    =  $request->last_question;
                $prepostpayment['last_ans_type']    =  $request->last_ans_type;
                $prepost = PrePostPayment::create($prepostpayment);
            }
            Notify::success('Pre Post Payment Created Successfully.');
            return redirect()->route('admin.pre.index');
        }catch(\Exception $e){
            return back()-> with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Pre data
    @input: Pre
    @Output: Update Pre data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, $id){
        $validatedData = Validator::make($request->all(),[
            'country_id'       => 'required',
            'visa'             => 'required',
            'question'          => 'required',
            'answer_type'       => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            if($request->answer_type === 'text' || $request->answer_type === 'datepicker'){
                $prepostpayment['question'] = $request->question;
                $prepostpayment['payment_status'] =  "pre";
                $prepostpayment['answer_type'] =  $request->answer_type;
                PrePostPayment::where('u_id', $id)->update($prepostpayment);
            }else if($request->answer_type === 'drop-down'){
                $proceed='';
                if(isset($request->proceed) && $request->proceed === '1'){
                    $proceed = $request->proceed;
                }else{
                    $proceed = '0';
                }
                $sub_proceed='';
                if(isset($request->sub_proceed) && $request->sub_proceed === '1'){
                    $sub_proceed = $request->sub_proceed;
                }else{
                    $sub_proceed = '0';
                }
                $prepostpayment['question']         =  $request->question;
                $prepostpayment['answer_type']      =  $request->answer_type;
                $prepostpayment['add_droup']        =  $request->add_droup;
                $prepostpayment['note']             =  $request->note;
                $prepostpayment['proceed']          =  $proceed;
                $prepostpayment['tooltip']          =  $request->tooltip;
                $prepostpayment['sub_question']     =  $request->sub_question;
                $prepostpayment['sub_ans_type']     =  $request->sub_ans_type;
                $prepostpayment['sub_add_drop']     =  $request->sub_add_drop;
                $prepostpayment['sub_note']         =  $request->sub_note;
                $prepostpayment['sub_proceed']      =  $request->sub_proceed;
                $prepostpayment['sub_tooltip']      =  $request->sub_tooltip;
                $prepostpayment['last_question']    =  $request->last_question;
                $prepostpayment['last_ans_type']    =  $request->last_ans_type;
                $prepost = PrePostPayment::where('u_id', $id)->update($prepostpayment);
            }
            PaymentCountry::where('id', $id)->update([ 'visa'   => $request->visa, ]);
            Notify::success('Pre Question Updated Successfully.');
            return redirect()->route('admin.pre.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for show
    @input: id
    @Output: show Pre
    -------------------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $prepostpayment = PrePostPayment::with(['pre_country'])->where('u_id',$request->id)->get();
        return view($this->pageLayout.'show',compact('prepostpayment'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Pre Status
    @input: Pre
    @Output: Status Pre Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $prepostpayment = PrePostPayment::where('u_id',$request->id)->first();
            if($prepostpayment->status == "active"){
                PrePostPayment::where('u_id',$request->id)->update([
                    'status' => "block",
                ]);
            }else{
                PrePostPayment::where('u_id',$request->id)->update([
                    'status'=> "active",
                ]);
            }
            Notify::success('Pre Post Payment status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Pre Post Payment status updated successfully.'
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
    @Description: Function for destroy
    @input: id
    @Output: delete Pre
    -------------------------------------------------------------------------------------------- */
    public function delete(PrePostPayment $PrePostPayment, $id){
        $userRole = Helper::checkPermission(['question-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        try{
            PrePostPayment::where('u_id', $id)->delete();
            Notify::success('Embassy Deleted Successfully.');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Pre Question Deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Pre
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
        $userRole = Helper::checkPermission(['price-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        $prepostpayment = PaymentCountry::with(['pre_list'])->where('id', $id)->first();
        return view($this->pageLayout.'edit',compact('country_list','prepostpayment','visa_types'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Pre For Country Index
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function country_index(Builder $builder, Request $request, $id){
        $country_id='';
        if($id){
            $prepayment = PrePostPayment::where('payment_status','pre')->join('payment_country','pre_post_payment.u_id','=','payment_country.id')->where('payment_country.country_id', $id)->groupBy('pre_post_payment.u_id')->orderBy('pre_post_payment.id','desc');
            $country_id=$id;
        }else{
            $prepayment = PrePostPayment::where('payment_status','pre')->groupBy('u_id')->orderBy('id','desc');
        }
        if (request()->ajax()) {
            return DataTables::of($prepayment->get())
            ->addIndexColumn()
            ->editColumn('status', function (PrePostPayment $prepayment) {
                if ($prepayment->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('action', function (PrePostPayment $prepayment) {
                $action = '';
                $action .='<a class="btn btn-info btn-sm ml-2 mr-2 viewpre" data-id ="'.$prepayment->u_id.'" href="javascript:void(0)"><i class="fa fa-eye"></i></a>';
                $action .='<a href='.route('admin.pre.edit',[$prepayment->u_id]).' class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                $action .='<a class="btn btn-sm btn-danger m-l-1 deletepre" data-id ="'.$prepayment->u_id.'" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                if($prepayment->status == "active"){
                    $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$prepayment->u_id.'"><i class="fa fa-unlock"></i></a>';
                }else{
                    $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$prepayment->u_id.'"><i class="fa fa-lock" ></i></a>';
                }
                return $action;
            })
            ->editColumn('answer_type', function (PrePostPayment $prepayment) {
                return ucfirst($prepayment->answer_type);
            })
            ->editColumn('u_id', function (PrePostPayment $prepayment) {
                if(!empty($prepayment->pre_country) && !empty($prepayment->pre_country->country)){
                    return $prepayment->pre_country->country->country;
                }else{
                    return '-';
                }
            })
            ->editColumn('visa_types', function (PrePostPayment $prepayment) {
                return $prepayment->pre_country->pre_visa_list->visa_type;
            })
            ->rawColumns(['action','status','u_id'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'u_id', 'name'    => 'u_id', 'title' => 'Country','width'=>'5%'],
            ['data' => 'question', 'name'    => 'question', 'title' => 'Question','width'=>'5%'],
            ['data' => 'answer_type', 'name' => 'answer_type', 'title' => 'Answer Type','width'=>'5%'],
            ['data' => 'visa_types', 'name' => 'visa_types', 'title' => 'Visa Type','width'=>'5%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'3%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'searching'   => true,
        ]);
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        return view($this->pageLayout.'index',compact('html','country_list','visa_types','country_id'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Pre For Visa Type Index
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function visatype_index(Builder $builder, Request $request, $id){
        $visatypeid = '';
        if($id){
            $prepayment = PrePostPayment::where('payment_status','pre')->join('payment_country','pre_post_payment.u_id','=','payment_country.id')->where('payment_country.visa', $id)->groupBy('pre_post_payment.u_id')->orderBy('pre_post_payment.id','desc');
            $visatypeid= $id;
        }else{
            $prepayment = PrePostPayment::where('payment_status','pre')->groupBy('u_id')->orderBy('id','desc');
        }
        if (request()->ajax()) {
            return DataTables::of($prepayment->get())
            ->addIndexColumn()
            ->editColumn('status', function (PrePostPayment $prepayment) {
                if ($prepayment->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('action', function (PrePostPayment $prepayment) {
                $action = '';
                $action .='<a class="btn btn-info btn-sm ml-2 mr-2 viewpre" data-id ="'.$prepayment->u_id.'" href="javascript:void(0)"><i class="fa fa-eye"></i></a>';
                $action .='<a href='.route('admin.pre.edit',[$prepayment->u_id]).' class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                $action .='<a class="btn btn-sm btn-danger m-l-1 deletepre" data-id ="'.$prepayment->u_id.'" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                if($prepayment->status == "active"){
                    $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$prepayment->u_id.'"><i class="fa fa-unlock"></i></a>';
                }else{
                    $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$prepayment->u_id.'"><i class="fa fa-lock" ></i></a>';
                }
                return $action;
            })
            ->editColumn('question', function (PrePostPayment $prepayment) {
                return Str::words($prepayment->question, 4,'....');
            })
            ->editColumn('answer_type', function (PrePostPayment $prepayment) {
                return ucfirst($prepayment->answer_type);
            })
            ->editColumn('u_id', function (PrePostPayment $prepayment) {
                if(!empty($prepayment->pre_country) && !empty($prepayment->pre_country->country)){
                    return $prepayment->pre_country->country->country;
                }else{
                    return '-';
                }
            })
            ->editColumn('visa_types', function (PrePostPayment $prepayment) {
                return $prepayment->pre_country->pre_visa_list->visa_type;
            })
            ->rawColumns(['action','status','u_id','question','answer'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'u_id', 'name'    => 'u_id', 'title' => 'Country','width'=>'5%'],
            ['data' => 'question', 'name'    => 'question', 'title' => 'Question','width'=>'5%'],
            ['data' => 'answer_type', 'name' => 'answer_type', 'title' => 'Answer Type','width'=>'5%'],
            ['data' => 'visa_types', 'name' => 'visa_types', 'title' => 'Visa Type','width'=>'5%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'3%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'searching'   => true,
        ]);
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        return view($this->pageLayout.'index',compact('html','country_list','visa_types','visatypeid'));
    }
}