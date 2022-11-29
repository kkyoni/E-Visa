<?php
namespace App\Http\Controllers\Admin;
use App\CountryVisaFee;
use App\CountryWiseVisa;
use App\VisaType;
use App\VisaTypeEntry;
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

class VisaTypeEntryController extends Controller{
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
        $this->pageLayout = 'admin.pages.visa_type_entries.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Visa Type Entry
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['visatype-list','visatype-create','visatype-edit','visatype-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['visatype-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['visatype-edit']);
        $visatypes = VisaTypeEntry::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($visatypes->get())
            ->addIndexColumn()
            ->editColumn('status', function (VisaTypeEntry $visatypes) {
                if ($visatypes->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->editColumn('action', function (VisaTypeEntry $visatypes) use($permission_data) {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a href='.route('admin.visa_type_entry.edit',[$visatypes->id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                }
                if($visatypes->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$visatypes->id.'" title="Active"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$visatypes->id.'" title="Block"><i class="fa fa-lock"></i></a>';
                    }
                if($permission_data['hasRemovePermission']){
                    $checkcountryvisa = CountryVisaFee::where('visa_type_entry_id', $visatypes->id)->first();
                    if(empty($checkcountryvisa)){
                        $action .='<a class="btn btn-danger btn-sm ml-1 mr-1 deletevisatype" data-id ="'.$visatypes->id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
                    }
                }
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'visa_type_entry', 'name' => 'visa_type_entry', 'title' => 'Visa Type Entry','width'=>'10%'],
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
    @input: Visa Type Entry
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
        $userRole = Helper::checkPermission(['visatype-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        return view($this->pageLayout.'create');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Visa Type Entry data
    @input: Visa Type Entry
    @Output: store Visa Type Entry data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'visa_type_entry'              => 'required|unique:visa_type_entries,visa_type_entry,NULL,id,deleted_at,NULL',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $userID=VisaTypeEntry::create([
                'visa_type_entry' => @$request->get('visa_type_entry'),
                'status'          => @$request->get('status'),
            ]);
            Notify::success('Visa Type Entry Created Successfully.');
            return redirect()->route('admin.visa_type_entry.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }


    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Visa Type Entry
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit(VisaTypeEntry $visatypeentry, $id){
        $userRole = Helper::checkPermission(['visatype-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $visatypeentry = VisaTypeEntry::find($id);
        return view($this->pageLayout.'edit', compact('visatypeentry'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Visa Type Entry data
    @input: Visa Type Entry
    @Output: Update Visa Type Entry data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, VisaTypeEntry $visatypeentry, $id){
        $validatedData = Validator::make($request->all(),[
            'visa_type_entry'              => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            VisaTypeEntry::where('id', $id)->update([
                'visa_type_entry' => @$request->get('visa_type_entry'),
                'status'          => @$request->get('status'),
            ]);
            Notify::success('Visa Type Entry Updated Successfully.');
            return redirect()->route('admin.visa_type_entry.index');
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
    @Output: delete Visa Type Entry
    -------------------------------------------------------------------------------------------- */
    public function delete(VisaTypeEntry $visatypeentry, $id){
        $userRole = Helper::checkPermission(['visatype-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        try{
            VisaTypeEntry::where('id', $id)->delete();
            Notify::success('Visa Type Entry Updated Successfully.');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Visa Type Entry deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Visa Type Entry Status
    @input: Visa Type Entry
    @Output: Status Visa Type Entry Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        $visatypeentry = VisaTypeEntry::where('id',$request->id)->first();
        if($visatypeentry->status == "active"){
            VisaTypeEntry::where('id',$request->id)->update([
                'status'  => "inactive",
            ]);
        }
        if($visatypeentry->status == "inactive"){
            VisaTypeEntry::where('id',$request->id)->update([
                'status'  => "active",
            ]);
        }
        Notify::success('Visa Type Entry Status updated Successfully.');
        return response()->json([
            'status'    => 'success',
            'title'     => 'Success!!',
            'message'   => 'Visa Type Entry Status updated successfully.'
        ]);
    }
}