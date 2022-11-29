<?php
namespace App\Http\Controllers\Admin;
use App\RoleHasPermissions;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Notify,Validator,Str,Storage,Auth;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Permission;
use App\Helpers\Helper;

class RoleController extends Controller{
   public function __construct(){
       $this->authLayout = 'admin.auth.';
       $this->pageLayout = 'admin.pages.';
       $this->middleware('auth');
   }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Role
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder){
    // role ane permission check
        $userRole = '';
        $userRole = Helper::checkPermission(['role-list','role-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['role-edit']);
        // role ane permission check
        $users = User::with('role')
        ->whereHas('role',function ($q){
            return $q->where('name','!=','user')->where('name','!=','admin');
        })
        ->orderBy('id','desc')->get();
        if (request()->ajax()) {
            return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('status', function (User $roles) {
                if ($roles->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('encrypt_password', function (User $roles) {
                return base64_decode($roles->encrypt_password);
            })
            ->editColumn('action', function (User $roles) use($permission_data) {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a href='.route('admin.role.edit',[$roles->id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                }
                $action .='<a class="btn btn-info btn-sm" href='.route('admin.role.view',[$roles->id]).' title="View"><i class="fa fa-eye"></i></a>';
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name' => 'name', 'title' => 'Back Office Level','width'=>'15%'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email','width'=>'20%'],
            ['data' => 'encrypt_password', 'name' => 'encrypt_password', 'title' => 'Password','width'=>'20%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'10%'],
            ['data' => 'action', 'name' => 'Action', 'title' => 'Action', "orderable"=> false, "searchable"=> false,'width'=>'10%'],
            ]);
        return view($this->pageLayout.'role.index', compact('html'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for create page view
    @input: Role
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
    // if(!auth()->guard('web')->user()->hasPermissionTo('role-create')){
    //     $message = 'You have not permission to create User.';
    //     return view('error.permission',compact('message'));
    // }
    return view($this->pageLayout.'role.bo_level');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Role data
    @input: Role
    @Output: store Role data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|unique:bo_level|max:20',
            'email' => 'required|email|unique:bo_level,email',
            'password' => 'required|min:6|max:16',
            'status' => 'required',
        ]);
        $bo_level = new User();
        $bo_level->name = $request->name;
        $bo_level->email = $request->email;
        $bo_level->password = \Hash::make($request->password);
        $bo_level->encrypt_password = $request->password;
        $bo_level->status = $request->status;
        $bo_level->save();
        $permission = Permission::defaultPermissions();
        $role = Role::create(['name'=>$bo_level->name]);
        $role->save();
        $bo_level1 = User::find($bo_level->id);
        $bo_level1->role_id = $role->id;
        $bo_level1->save();
        $role->syncPermissions($permission);
        Notify::success('Role added successfully.');
        return redirect()->route('admin.role.index');
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for show
    @input: id
    @Output: show Role
    -------------------------------------------------------------------------------------------- */
    public function view(Request $request,$id){
        $bol = User::where('id','=',$id)->first();
        if (!$bol){
            $message = 'You have not correct your User Id.';
            return view('error.permission',compact('message'));
        }
        $role = RoleHasPermissions::with('permission')->where('role_id','=',$bol->role_id)->get();
        $user_permission=[];
        foreach ($role as $key=>$value){
            foreach ($value->permission as $perm){
                $user_permission[]=$perm;
            }
        }
        $permissions = Permission::all();
        $permission = [];
        foreach ($permissions as $key => $value) {
            $permission[$value->module_name][] = $value;
        }
        $heading =  'Add Role';
        $bank_office_level = User::whereIn('role_id',['3','4','5','6','7','8','9','10','11','12'])->get();
        $bank_office_level_key=[];
        foreach ($bank_office_level as $key=>$value){
            $bank_office_level_key[$value->id]=$value->name;
        }
        $bank_office_level=$bank_office_level_key;
        return view('admin.pages.role.view',compact('permission','user_permission','bol','bank_office_level'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Role
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
    // role ane permission check
        $userRole = '';
        $userRole = Helper::checkPermission(['role-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $bol = User::where('id','=',$id)->first();
        if (!$bol){
            $message = 'You have not correct your User Id.';
            return view('error.permission',compact('message'));
        }
        $role = RoleHasPermissions::with('permission')->where('role_id','=',$bol->role_id)->get();
        $user_permission=[];
        foreach ($role as $key=>$value){
            foreach ($value->permission as $perm){
                $user_permission[]=$perm;
            }
        }
        $permissions = Permission::all();
        $permission = [];
        foreach ($permissions as $key => $value) {
            $permission[$value->module_name][] = $value;
        }
        $heading =  'Update Role';
        $bank_office_level = User::whereIn('role_id',['3','4','5','6','7','8','9','10','11','12'])->get();
        $bank_office_level_key=[];
        foreach ($bank_office_level as $key=>$value){
            $bank_office_level_key[$value->id]=$value->name;
        }
        $bank_office_level=$bank_office_level_key;
        return view('admin.pages.role.create',compact('permission','user_permission','bol','bank_office_level'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Role data
    @input: Role
    @Output: Update Role data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'id' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($request->id);
        $role->syncPermissions($request->permission);
        Notify::success('Role updated successfully.');
        return redirect()->route('admin.role.index');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for destroy
   @input: id
   @Output: delete Role
    -------------------------------------------------------------------------------------------- */
    public function destroy($id){
        $role = Role::where('id',$id)->first();
        $role->delete();
        return ["status"=>'success',"message"=>'Record deleted sucessfully'];
        return redirect()->to('admin/role');
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for destroy
    @input: id
    @Output: delete counrty
    -------------------------------------------------------------------------------------------- */
    public function addRole(Request $request){
        // dd($request->all());
        $id = $request->id;
        $validatedData = Validator::make($request->all(),[
            'name'                 => 'required',
            'email'                => 'required|email|unique:users,email,'.$id,
            'mobile'               => 'required|min:11|numeric',
            'wpmobile'             => 'required|min:11|numeric',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
        $oldDetails = User::find($id);
        if($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10).'.'.$extension;
            \Storage::disk('public')->putFileAs('avatar', $file,$filename);
        }else{
            if($oldDetails->avatar !== null){
                $filename = $oldDetails->avatar;
            }else{
                $filename = 'default.png';
            }
        }
        User::where('id',$id)->update([
                'name'                 => @$request->get('name'),
                'avatar'               => @$filename,
                'email'                => @$request->get('email'),
                'mobile'               => @$request->get('mobile'),
                'wpmobile'             => @$request->get('wpmobile'),
            ]);
        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permission);
        $oldDetails = User::find($request->role_id);
        Notify::success('Role updated successfully.');
        return redirect()->route('admin.role.index');
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
    @Output: delete counrty
    -------------------------------------------------------------------------------------------- */
    public function getPermissionDetail(Request $request){
        $bol = User::where('id','=',$request->id)->first();
        if (!$bol){
            $message = 'You have not correct your User Id.';
            return view('error.permission',compact('message'));
        }
        $role = RoleHasPermissions::with('permission')->where('role_id','=',$bol->role_id)->get();
        $user_permission=[];
        foreach ($role as $key=>$value){
            foreach ($value->permission as $perm){
                $user_permission[]=$perm;
            }
        }
        $permissions = Permission::all();
        $permission = [];
        foreach ($permissions as $key => $value) {
            $permission[$value->module_name][] = $value;
        }
        $heading =  'Add Role';
        $bank_office_level = User::whereIn('role_id',['3','4','5','6','7','8','9','10','11','12'])->get();
        $bank_office_level_key=[];
        foreach ($bank_office_level as $key=>$value){
            $bank_office_level_key[$value->id]=$value->name;
        }
        $bank_office_level=$bank_office_level_key;
        return response()->json([
            'permission'=>$permission,
            'user_permission'=>$user_permission,
            'bol'=>$bol,
            'bank_office_level'=>$bank_office_level
            ]);
        return view('admin.pages.role.view',compact('permission','user_permission','bol','bank_office_level'));
    }
}