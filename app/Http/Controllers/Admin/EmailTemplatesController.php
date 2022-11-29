<?php
namespace App\Http\Controllers\Admin;
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
use App\EmailTemplates;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;

class EmailTemplatesController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.emailtemplates.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Email Templates
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['email-template-list','email-template-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['email-template-edit']);
        $emailtemplates = EmailTemplates::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($emailtemplates->get())
            ->addIndexColumn()
            ->editColumn('status', function (EmailTemplates $emailtemplates) {
                if ($emailtemplates->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('action', function (EmailTemplates $emailtemplates) use($permission_data)  {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a href='.route('admin.emailtemplates.edit',[$emailtemplates->id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                    if($emailtemplates->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$emailtemplates->id.'" title="Active"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$emailtemplates->id.'" title="Block"><i class="fa fa-lock"></i></a>';
                    }
                }
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'title', 'name'    => 'title', 'title' => 'Title','width'=>'15%'],
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
        return view($this->pageLayout.'index',compact('html'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Email Templates Status
    @input: Email Templates
    @Output: Status Email Templates Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $emailtemplates = EmailTemplates::where('id',$request->id)->first();
            if($emailtemplates->status == "active"){
                EmailTemplates::where('id',$request->id)->update([
                    'status' => "block",
                ]);
            }else{
                EmailTemplates::where('id',$request->id)->update([
                    'status'=> "active",
                ]);
            }
            Notify::success('Email Templates status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Email Templates status updated successfully.'
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
    @Description: Function for edit
    @input: Email Templates
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
        $userRole = Helper::checkPermission(['email-template-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $emailtemplates = EmailTemplates::find($id);
        return view($this->pageLayout.'edit',compact('emailtemplates','id'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Email Templates data
    @input: Email Templates
    @Output: Update Email Templates data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, EmailTemplates $emailtemplates, $id){
        $validatedData = Validator::make($request->all(),[
            'title'           => 'required',
            'description'     => 'required',
            'status'          => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $emailtemplates = EmailTemplates::where('id', $id)->update([
                'title'          => @$request->title,
                'description'    => @$request->get('description'),
                'status'         => @$request->get('status'),
            ]);
            Notify::success($request->title.' Email Templates Updated Successfully.');
            return redirect()->route('admin.emailtemplates.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}