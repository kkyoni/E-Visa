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
use App\Cms;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;

class CmsController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.cms.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: CMS
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['cms-list','cms-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['cms-edit']);
        $cms = Cms::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($cms->get())
            ->addIndexColumn()
            ->editColumn('status', function (Cms $cms) {
                if ($cms->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('action', function (Cms $cms) use($permission_data){
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a href='.route('admin.cms.edit',[$cms->id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                    if($cms->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$cms->id.'" title="Active"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$cms->id.'" title="Block"><i class="fa fa-lock" ></i></a>';
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
    @Description: Function for CMS Status
    @input: CMS
    @Output: Status CMS Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $cms = Cms::where('id',$request->id)->first();
            if($cms->status == "active"){
                Cms::where('id',$request->id)->update([
                    'status' => "block",
                ]);
            }else{
                Cms::where('id',$request->id)->update([
                    'status'=> "active",
                ]);
            }
            Notify::success('Cms status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Cms status updated successfully.'
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
    @input: CMS
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
        $userRole = Helper::checkPermission(['cms-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $cms = Cms::find($id);
        return view($this->pageLayout.'edit',compact('cms','id'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update CMS data
    @input: CMS
    @Output: Update CMS data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, Cms $cms, $id){
        $validatedData = Validator::make($request->all(),[
            'title'           => 'required',
            'description'     => 'required',
            'status'          => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $cms = Cms::where('id', $id)->update([
                'title'          => @$request->title,
                'description'    => @$request->get('description'),
                'status'         => @$request->get('status'),
            ]);
            Notify::success($request->title.' CMS Updated Successfully.');
            return redirect()->route('admin.cms.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}