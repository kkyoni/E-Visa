<?php
namespace App\Http\Controllers\Admin;
use App\CountryWiseVisa;
use App\Faq;
use App\Price;
use App\User;
use App\VisaType;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Builder;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Validator,Str,Storage;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;

class VisaTypeController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.visa_types.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Visa Type
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['visa-list','visa-create','visa-edit','visa-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['visa-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['visa-edit']);
        $visatypes = VisaType::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($visatypes->get())
            ->addIndexColumn()
            ->editColumn('status', function (VisaType $visatypes) {
                if ($visatypes->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->editColumn('action', function (VisaType $visatypes) use($permission_data) {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a href='.route('admin.visa_types.edit',[$visatypes->id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                }
                if($visatypes->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$visatypes->id.'" title="Active"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$visatypes->id.'" title="Block"><i class="fa fa-lock"></i></a>';
                    }
                if($permission_data['hasRemovePermission']){
                    $checkvisaforprice = Price::where('visa_type_id', $visatypes->id)->first();
                    $checkcountryvisa = CountryWiseVisa::where('visa_type_id', $visatypes->id)->first();
                    $checkfaqvisa =  Faq::where('visa_type_id', $visatypes->id)->first();
                    if(empty($checkvisaforprice) && empty($checkcountryvisa) && empty($checkfaqvisa)){
                        $action .='<a class="btn btn-sm btn-danger ml-1 mr-1 deletevisatype" data-id ="'.$visatypes->id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
                    }
                }
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'visa_type', 'name' => 'visa_type', 'title' => 'Visa Type','width'=>'10%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'5%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'8%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'searching'   => true,
        ]);
        $roles = Role::pluck('name','id');
        \View::share('roles',$roles);
        return view($this->pageLayout.'index',compact('html'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for create page view
    @input: Visa Types
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
        $userRole = Helper::checkPermission(['visa-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        return view($this->pageLayout.'create');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Visa Types data
    @input: Visa Types
    @Output: store Visa Types data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'visa_type'              => 'required|unique:visa_types,visa_type,NULL,id,deleted_at,NULL',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $userID=VisaType::create([
                'visa_type' => @$request->get('visa_type'),
                'status'    => @$request->get('status'),
            ]);
            Notify::success('Visa Type Created Successfully.');
            return redirect()->route('admin.visa_types.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Visa Types
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit(VisaType $visaType, $id){
        $userRole = Helper::checkPermission(['visa-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $visatype = VisaType::find($id);
        return view($this->pageLayout.'edit', compact('visatype'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Visa Types data
    @input: Visa Types
    @Output: Update Visa Types data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, VisaType $visaType, $id){
        $validatedData = Validator::make($request->all(),[
            'visa_type'              => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            VisaType::where('id', $id)->update([
                'visa_type' => @$request->get('visa_type'),
                'status'    => @$request->get('status'),
            ]);
            Notify::success('Visa Type Updated Successfully.');
            return redirect()->route('admin.visa_types.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for destroy
    @input: id
    @Output: delete Visa Types
    -------------------------------------------------------------------------------------------- */
    public function delete(VisaType $visaType, $id){
        $userRole = Helper::checkPermission(['visa-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        try{
            VisaType::where('id', $id)->delete();
            Notify::success('Visa Type Updated Successfully.');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Visa Type deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Visa Types Status
    @input: Visa Types
    @Output: Status Visa Types Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        $visatype = VisaType::where('id',$request->id)->first();
        if($visatype->status == "active"){
            VisaType::where('id',$request->id)->update([
                'status'  => "inactive",
            ]);
        }
        if($visatype->status == "inactive"){
            VisaType::where('id',$request->id)->update([
                'status'  => "active",
            ]);
        }
        Notify::success('Visa Type status updated successfully !!');
        return response()->json([
            'status'    => 'success',
            'title'     => 'Success!!',
            'message'   => 'Visa Type status updated successfully !!'
        ]);
    }

}