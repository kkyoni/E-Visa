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
use App\Embassy;
use App\Country;
use App\CountryEmbassy;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;

class EmbassyController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.embassy.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Embassy
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['emb-list','emb-create','emb-edit','emb-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['emb-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['emb-edit']);
        $embassy = Embassy::with(['embassy_country','country_list'])->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($embassy->get())
            ->addIndexColumn()
            ->editColumn('status', function (Embassy $embassy) {
                if ($embassy->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })

            ->editColumn('country_id', function (Embassy $embassy) {
            	return $embassy->country_list->country;
            })
            ->editColumn('embassy_id', function (Embassy $embassy) {
            	return $embassy->embassy_country->country;
            })
            ->editColumn('action', function (Embassy $embassy) use($permission_data) {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a class="btn btn-info btn-sm m-l-10 viewEmbassy" data-id ="'.$embassy->id.'" data-toggle="modal" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                    $action .='<a href='.route('admin.embassy.edit',[$embassy->id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                }

                if($embassy->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$embassy->id.'" title="Active"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$embassy->id.'" title="Block"><i class="fa fa-lock"></i></a>';
                    }

                if($permission_data['hasRemovePermission']){
                    $action .='<a class="btn btn-danger btn-sm ml-1 mr-1 deleteembassy" data-id ="'.$embassy->id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'country_id', 'name'    => 'country_id', 'title' => 'Country','width'=>'15%'],
            ['data' => 'embassy_id', 'name'    => 'embassy_id', 'title' => 'Embassy','width'=>'15%'],
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
    @Description: Function for create page view
    @input: Embassy
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
        $userRole = Helper::checkPermission(['emb-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $country_list = Country::pluck('country','id');
        $embassy=array();
        return view($this->pageLayout.'create',compact('country_list','embassy'));
    }


    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Embassy data
    @input: Embassy
    @Output: store Embassy data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'country_id'       => 'required',
            'embassy_id'       => 'required',
            'address'          => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            if(isset($request->embassy_id)){
                foreach ($request->embassy_id as $key => $value) {
                    $checkembassy = Embassy::where('country_id', $request->country_id)->where('embassy_id', $value)->first();
                    if(empty($checkembassy)){
                        $embassy['country_id'] = $request->country_id;
                        $embassy['embassy_id'] = $value;
                        $embassy['address'] = $request->address[$key];
                        Embassy::create($embassy);
                    }else{
                        Notify::error('Something went wrong.');
                        return redirect()->back();
                    }
                }
            }
            Notify::success('Embassy Created Successfully.');
            return redirect()->route('admin.embassy.index');
        }catch(\Exception $e){
            return back()-> with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
    
    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Embassy
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
    // role ane permission check
        $userRole = Helper::checkPermission(['emb-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        // role ane permission check
        $country_list = Country::pluck('country','id');
        $embassy = Embassy::with(['embassy_country','country_list'])->where('id', $id)->first();
        return view($this->pageLayout.'edit',compact('country_list','embassy'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Embassy data
    @input: Embassy
    @Output: Update Embassy data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, $id){
        $validatedData = Validator::make($request->all(),[
            'country_id'       => 'required',
            'embassy_id'       => 'required',
            'address'          => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $checkembassy = Embassy::where('id', $id)->where('country_id', $request->country_id)->where('embassy_id', $request->embassy_id)->first();
            if(!empty($checkembassy)){
                Embassy::where('id', $id)->update([
                    'country_id' => $request->country_id,
                    'embassy_id' => $request->embassy_id,
                    'address'    => $request->address,
                ]);
            }
            Notify::success('Embassy Updated Successfully.');
            return redirect()->route('admin.embassy.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for change_status
    @input: id
    @Output: Embassy
    -------------------------------------------------------------------------------------------- */
    public function embassy_change_status(Request $request){
        try{
            $embassy = Embassy::where('id',$request->id)->first();
            if($embassy->status == "active"){
                Embassy::where('id',$request->id)->update([
                    'status' => "block",
                ]);
            }else{
                Embassy::where('id',$request->id)->update([
                    'status'=> "active",
                ]);
            }
            Notify::success('Embassy status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Embassy status updated successfully.'
            ]);
        }catch (Exception $e){
            return response()->json([
                'status'    => 'error',
                'title'     => 'Error!!',
                'message'   => $e->getMessage()
            ]);
        }
    }

    public function view($id){
        $embassy = Embassy::with(['embassy_country','country_list'])->get();
        return view('admin.pages.embassy.view',compact('embassy'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for destroy
    @input: id
    @Output: delete Embassy
    -------------------------------------------------------------------------------------------- */
    public function delete(Embassy $embassy, $id){
        try{
        // role ane permission check
            $userRole = Helper::checkPermission(['emb-delete']);
            if(!$userRole){
                $message = "You don't have permission to access this module.";
                return view('error.permission',compact('message'));
            }
            // role ane permission check
            Embassy::where('id', $id)->delete();
            Notify::success('Embassy Deleted Successfully.');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Embassy Deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for ShowEmbassy
    @input: id
    @Output: Embassy
    -------------------------------------------------------------------------------------------- */
    public function ShowEmbassy($id){
        try{
            $transactiondetail = Embassy::with(['embassy_country','country_list'])->where('id',$id)->first();
            return response()->json([
                'address'              => @$transactiondetail->address,
                'country'              => @$transactiondetail->country_list->country,
                'embassy'              => @$transactiondetail->embassy_country->country,
                'status'               => @$transactiondetail->status,
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for Get Country
    @input: id
    @Output: counrty
    -------------------------------------------------------------------------------------------- */
    public function getcountry(){
        try{
            $countries = Country::select('country','id')->get();
            return response()->json([
                'countries'              => @$countries
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}