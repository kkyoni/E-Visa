<?php
namespace App\Http\Controllers\Admin;
use App\Cms;
use App\Country;
use App\PrePostPayment;
use App\Price;
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
use App\User;
use App\Embassy;
use App\CountryEmbassy;
use App\Faq;use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;

class FaqController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.faq.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: FAQ
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
    // role ane permission check
        $userRole = '';
        $userRole = Helper::checkPermission(['faq-list','faq-create','faq-edit','faq-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['price-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['price-edit']);
        // role ane permission check
        $faq = Faq::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($faq->get())
            ->addIndexColumn()
            ->editColumn('country_id', function (Faq $faq) {
                if(!empty($faq->country)){
                    return $faq->country->country;
                }else{
                    return '-';
                }
            })
            ->editColumn('visa_type_id', function (Faq $faq) {
                if(!empty($faq->visatype)){
                    return $faq->visatype->visa_type;
                }else{
                    return '-';
                }
            })
            ->editColumn('question', function (Faq $faq) {
                return mb_strimwidth($faq->question, 0, 50, " ...");
            })
            ->editColumn('answer', function (Faq $faq) {
                return mb_strimwidth($faq->answer, 0, 50, " ...");
            })
            ->editColumn('order_by', function (Faq $faq) {
                return '<input style="height: 35px;" type="number" step="1" data-id="'.$faq->id.'" data-value="'.$faq->order_by.'" class="form-control form-control-md slider_order" value="'.$faq->order_by.'"/>';
            })
            ->editColumn('status', function (Faq $faq) {
                if ($faq->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('action', function (Faq $faq) use($permission_data) {
                $action = "";
                if($permission_data['hasUpdatePermission']){
                    $action .='<a href='.route('admin.faq.edit',[$faq->id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                }
                if($permission_data['hasRemovePermission']){
                    $action .='<a class="btn btn-danger btn-sm ml-1 mr-1 deletefaq" data-id ="'.$faq->id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
                }

                if($permission_data['hasUpdatePermission']){
                    if($faq->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$faq->id.'" title="Active"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$faq->id.'" title="Block"><i class="fa fa-lock"></i></a>';
                    }
                }
                return $action;
            })
            ->rawColumns(['action','answer','question','status','order_by'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'visa_type_id', 'name'    => 'visa_type_id', 'title' => 'Visa Type','width'=>'10%'],
            ['data' => 'country_id', 'name'    => 'country_id', 'title' => 'Country','width'=>'7%'],
            ['data' => 'question', 'name'    => 'question', 'title' => 'Question','width'=>'25%',"orderable" => false, "searchable" => false],
            ['data' => 'status', 'name' => 'status', 'title' => 'status','width'=>'5%'],
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
        $country_id = $visatypeid = '';
        return view($this->pageLayout.'index',compact('html','country_list','visa_types','country_id','visatypeid'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for create page view
    @input: FAQ
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
    // role ane permission check
        $userRole = Helper::checkPermission(['faq-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        // role ane permission check
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        return view($this->pageLayout.'create',compact('country_list','visa_types'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store FAQ data
    @input: FAQ
    @Output: store FAQ data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'question'        => 'required|unique:faqs,question',
            'answer'          => 'required',
            'country_id'      => 'required',
            'visa_type_id'    => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $faq=Faq::create([
                'question'        => @$request->get('question'),
                'answer'          => @$request->get('answer'),
                'country_id'      => @$request->get('country_id'),
                'visa_type_id'    => @$request->get('visa_type_id'),
            ]);
            Notify::success('FAQ Created Successfully.');
            return redirect()->route('admin.faq.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: FAQ
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
    // role ane permission check
        $userRole = Helper::checkPermission(['faq-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        // role ane permission check
        $faq=Faq::where('id',$id)->get();
        $faq = Faq::find($id);
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        if($faq){
            return view($this->pageLayout.'edit',compact('country_list','visa_types','faq','id'));
        }else{
            return redirect()->route('admin.faq.index');
        }
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for update FAQ data
    @input: FAQ
    @Output: Update FAQ data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $validatedData = Validator::make($request->all(),[
            'question'        => 'required',
            'answer'          => 'required',
            'country_id'      => 'required',
            'visa_type_id'    => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $faq = Faq::find($id);
            Faq::where('id',$id)->update([
                'question'        => @$request->get('question'),
                'answer'          => @$request->get('answer'),
                'country_id'      => @$request->get('country_id'),
                'visa_type_id'    => @$request->get('visa_type_id'),
            ]);
            Notify::success('FAQ Updated Successfully.');
            return redirect()->route('admin.faq.index');
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
    @Output: show FAQ
    -------------------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $faqs = Faq::with(['country','visatype'])->where('id',$request->id)->first();
        return view($this->pageLayout.'show',compact('faqs'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for destroy
    @input: id
    @Output: delete FAQ
    -------------------------------------------------------------------------------------------- */
    public function delete($id){
    // role ane permission check
        $userRole = Helper::checkPermission(['faq-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        // role ane permission check
        try{
            $checkFaq = Faq::where('id',$id)->first();
            $checkFaq->delete();
            Notify::success('Faq deleted successfully.');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Faq deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for FAQ Status
    @input: FAQ
    @Output: Status FAQ Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        $Faq = Faq::where('id',$request->id)->first();
        if($Faq->status == "active"){
            Faq::where('id',$request->id)->update([
                'status'  => "block",
            ]);
        }
        if($Faq->status == "block"){
            Faq::where('id',$request->id)->update([
                'status'  => "active",
            ]);
        }
        Notify::success('FAQ Status updated Successfully.');
        return response()->json([
            'status'    => 'success',
            'title'     => 'Success!!',
            'message'   => 'FAQ Status updated successfully.'
        ]);
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for Slider Order
    @input: id
    @Output: Order FAQ
    -------------------------------------------------------------------------------------------- */
    public function sliderorder(Request $request){
        if($request->get('value') > 0){
            $faq = Faq::where('order_by',$request->get('value'))->get();
            if(sizeof($faq) > 0){
                return response()->json([
                    'status'    => 'error',
                    'title'     => 'Error!!',
                    'message'   => 'Please select another Order, it is already set.',
                ]);
            } else{
                try{
                    Faq::where('id',$request->get('id'))->update([
                        'order_by'       => $request->get('value')
                    ]);
                    return response()->json([
                        'status'      => 'success',
                        'title'       => 'Success!!',
                        'message'     => 'Order for Slider set.',
                    ]);
                }catch (\Exception $e){
                    return response()->json([
                        'status'    => 'error',
                        'title'     => 'Error!!',
                        'message'   => 'Please enter valid number.',
                    ]);
                }
            }
        }else{
            return response()->json([
                'status'    => 'error',
                'title'     => 'Error!!',
                'message'   => 'Please enter positive number.',
            ]);
        }
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for Visa index For FAQ
    @input: Visa Index For FAQ
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function visatype_index(Builder $builder, Request $request, $id){
        $faq = Faq::where('visa_type_id', $id)->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($faq->get())
            ->addIndexColumn()
            ->editColumn('country_id', function (Faq $faq) {
                if(!empty($faq->country)){
                    return $faq->country->country;
                }else{
                    return '-';
                }
            })
            ->editColumn('visa_type_id', function (Faq $faq) {
                if(!empty($faq->visatype)){
                    return $faq->visatype->visa_type;
                }else{
                    return '-';
                }
            })
            ->editColumn('question', function (Faq $faq) {
                return mb_strimwidth($faq->question, 0, 50, " ...");
            })
            ->editColumn('answer', function (Faq $faq) {
                return mb_strimwidth($faq->answer, 0, 50, " ...");
            })
            ->editColumn('order_by', function (Faq $faq) {
                return '<input style="height: 35px;" type="number" step="1" data-id="'.$faq->id.'" data-value="'.$faq->order_by.'" class="form-control form-control-md slider_order" value="'.$faq->order_by.'"/>';
            })
            ->editColumn('status', function (Faq $faq) {
                if ($faq->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('action', function (Faq $faq) {
                $action = "";
                $action .='<a href='.route('admin.faq.edit',[$faq->id]).' class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                $action .='<a class="btn btn-sm btn-danger m-l-10 deletefaq" data-id ="'.$faq->id.'" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                if($faq->status == "active"){
                    $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$faq->id.'"><i class="fa fa-unlock"></i></a>';
                }else{
                    $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$faq->id.'"><i class="fa fa-lock" ></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action','answer','question','status','order_by'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'visa_type_id', 'name'    => 'visa_type_id', 'title' => 'Visa Type','width'=>'10%'],
            ['data' => 'country_id', 'name'    => 'country_id', 'title' => 'Country','width'=>'7%'],
            ['data' => 'question', 'name'    => 'question', 'title' => 'Question','width'=>'25%',"orderable" => false, "searchable" => false],
            ['data' => 'status', 'name' => 'status', 'title' => 'status','width'=>'5%'],
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
        $visatypeid = $id;
        $country_id = '';
        return view($this->pageLayout.'index',compact('html','country_list','visa_types','visatypeid','country_id'));
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for Country index For FAQ
    @input: Country Index For FAQ
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function country_index(Builder $builder, Request $request, $id){
        $faq = Faq::where('country_id', $id)->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($faq->get())
            ->addIndexColumn()
            ->editColumn('country_id', function (Faq $faq) {
                if(!empty($faq->country)){
                    return $faq->country->country;
                }else{
                    return '-';
                }
            })
            ->editColumn('visa_type_id', function (Faq $faq) {
                if(!empty($faq->visatype)){
                    return $faq->visatype->visa_type;
                }else{
                    return '-';
                }
            })
            ->editColumn('question', function (Faq $faq) {
                return mb_strimwidth($faq->question, 0, 50, " ...");
            })
            ->editColumn('answer', function (Faq $faq) {
                return mb_strimwidth($faq->answer, 0, 50, " ...");
            })
            ->editColumn('order_by', function (Faq $faq) {
                return '<input style="height: 35px;" type="number" step="1" data-id="'.$faq->id.'" data-value="'.$faq->order_by.'" class="form-control form-control-md slider_order" value="'.$faq->order_by.'"/>';
            })
            ->editColumn('status', function (Faq $faq) {
                if ($faq->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('action', function (Faq $faq) {
                $action = "";
                $action .='<a href='.route('admin.faq.edit',[$faq->id]).' class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                $action .='<a class="btn btn-sm btn-danger m-l-10 deletefaq" data-id ="'.$faq->id.'" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                if($faq->status == "active"){
                    $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$faq->id.'"><i class="fa fa-unlock"></i></a>';
                }else{
                    $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$faq->id.'"><i class="fa fa-lock" ></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action','answer','question','status','order_by'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'visa_type_id', 'name'    => 'visa_type_id', 'title' => 'Visa Type','width'=>'10%'],
            ['data' => 'country_id', 'name'    => 'country_id', 'title' => 'Country','width'=>'7%'],
            ['data' => 'question', 'name'    => 'question', 'title' => 'Question','width'=>'25%',"orderable" => false, "searchable" => false],
            ['data' => 'status', 'name' => 'status', 'title' => 'status','width'=>'5%'],
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
        $country_id = $id;
        $visatypeid = '';
        return view($this->pageLayout.'index',compact('html','country_list','visa_types','visatypeid','country_id'));
    }
}