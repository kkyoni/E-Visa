<?php
namespace App\Http\Controllers\Admin;
use App\RoleHasPermissions;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Validator,Str,Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Builder;
use Auth;
use App\User;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Settings;
use App\Helpers\Helper;
use App\ContactUs;
use App\Themes;

class UsersController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.user.';
        $this->middleware('Admin');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: User
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['user-list','user-create','user-edit','user-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['user-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['user-edit']);
        $users = User::with('role')->whereHas('role',function ($q){
            return $q->where('name','=','user');
        })->orderBy('id','desc')->get();
        if (request()->ajax()) {
            return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('image', function (User $users){
                if(!$users->avatar){
                    return '<img class="img-thumbnail" src="' . asset('storage/avatar/default.png').'" width="60px">';
                }else{
                    return '<img class="img-thumbnail" src="' . asset('storage/avatar' . '/' . $users->avatar) . '" width="60px">';
                }
            })
            ->editColumn('status', function (User $operator) {
                if ($operator->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Block</span>';
                }
            })
            ->editColumn('action', function (User $users) use($permission_data) {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a class="btn btn-warning btn-sm" href='.route('admin.edit',[$users->id]).' title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                }if($permission_data['hasRemovePermission']){
                    $action .='<a class="btn btn-danger btn-sm m-l-10 deleteuser" data-id ="'.$users->id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
                }if($permission_data['hasUpdatePermission']){
                    if($users->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$users->id.'"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-2 mr-2 changeStatusRecord" data-id="'.$users->id.'"><i class="fa fa-lock" ></i></a>';
                    }
                }
                return $action;
            })
            ->rawColumns(['action','image','status','user_type'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'image', 'name'    => 'avatar', 'title' => 'Avatar','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name'    => 'name', 'title' => 'Name','width'=>'5%'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email','width'=>'15%'],
            ['data' => 'mobile', 'name' => 'mobile', 'title' => 'Mobile','width'=>'15%'],
            ['data' => 'passport', 'name' => 'passport', 'title' => 'Passport','width'=>'15%'],
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
    @input: User
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){    
        $userRole = Helper::checkPermission(['user-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        // role ane permission check
        return view($this->pageLayout.'create',compact('userRole'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: User
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
        $userRole = Helper::checkPermission(['user-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        // role ane permission check
        $users = User::find($id);
        return view($this->pageLayout.'edit',compact('users','id'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store User data
    @input: User
    @Output: store User data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'name'                => 'required',
            'email'               => 'required|email|unique:users,email',
            'mobile'              => 'required|min:11|numeric',
            'password'            => 'required|min:6',
            'passport'            => 'required',
            'passport_issue_date' => 'required|date',
            'passport_expiry_date'=> 'required|date',
            'wpmobile'            => 'required|min:11|numeric',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('avatar', $file,$filename);
            }else{
                $filename = 'default.png';
            }
            $userID=User::create([
                'name'                 => @$request->get('name'),
                'avatar'               => @$filename,
                'email'                => @$request->get('email'),
                'mobile'               => @$request->get('mobile'),
                'password'             => \Hash::make($request->get('password')),
                'passport'             => @$request->get('passport'),
                'passport_issue_date'  => date_create(@$request->get('passport_issue_date')),
                'passport_expiry_date' => date_create(@$request->get('passport_expiry_date')),
                'wpmobile'             => @$request->get('wpmobile'),
                'status'               => @$request->get('status'),
                'user_type'            => 'user',
                'role_id'              => 2,
            ]);
            Notify::success('User Created Successfully.');
            return redirect()->route('admin.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
    /* -----------------------------------------------------------------------------------------
    @Description: Function for update User data
    @input: User
    @Output: Update User data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $validatedData = Validator::make($request->all(),[
            'name'                 => 'required',
            'email'                => 'required|email|unique:users,email,'.$id,
            'mobile'               => 'required|min:11|numeric',
            'password'             => 'nullable|min:6',
            'passport'             => 'required',
            'passport_issue_date'  => 'required|date',
            'passport_expiry_date' => 'required|date',
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
            $password = $request->get('password') === null ?
            $oldDetails->password : \Hash::make($request->get('password'));
            User::where('id',$id)->update([
                'name'                 => @$request->get('name'),
                'avatar'               => @$filename,
                'email'                => @$request->get('email'),
                'mobile'               => @$request->get('mobile'),
                'password'             => \Hash::make($request->get('password')),
                'passport'             => @$request->get('passport'),
                'passport_issue_date'  => date_create(@$request->get('passport_issue_date')),
                'passport_expiry_date' => date_create(@$request->get('passport_expiry_date')),
                'wpmobile'             => @$request->get('wpmobile'),
                'status'               => @$request->get('status'),
                'user_type'            => 'user',
                'role_id'              => 2
            ]);
            $user_data =User::where('id',$id)->first();
            if(!empty($request->get('password'))){
                User::where('id',$id)->update([
                    'password'      =>  bcrypt($request->password),
                ]);
            }
            $admin = User::find($id);
            Notify::success('User Updated Successfully.');
            return redirect()->route('admin.index');
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
    @Output: delete User
    -------------------------------------------------------------------------------------------- */
    public function delete($id){
        try{
            $userRole = Helper::checkPermission(['user-delete']);
            if(!$userRole){
                $message = "You don't have permission to access this module.";
                return view('error.permission',compact('message'));
            }
            $checkUser = User::where('id',$id)->first();
            $checkUser->delete();
            Notify::success('User deleted successfully.');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'User deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for User Status
    @input: User
    @Output: Status User Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $user = User::where('id',$request->id)->first();
            if($user === null){
                return redirect()->back()->with([
                    'status'    => 'warning',
                    'title'     => 'Warning!!',
                    'message'   => 'User not found !!'
                ]);
            }else{
                if($user->status == "active"){
                    User::where('id',$request->id)->update([
                        'status' => "block",
                    ]);
                }
                if($user->status == "block"){
                    User::where('id',$request->id)->update([
                        'status'=> "active",
                    ]);
                }
            }
            Notify::success('User status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'User status updated successfully.'
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
    @Description: Function for Themes Status
    @input: Themes
    @Output: Status Themes Change 
    -------------------------------------------------------------------------------------------- */
    public function change_themes(Request $request){
        try{
         Themes::where('id',$request->id)->update([
                'color'    => $request->value,
            ]);
         Notify::success('Themes updated successfully !!');
         return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Themes updated successfully.'
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
    @Description: Function for Update profile details
    @input: name,email.
    @Output: update profile details
    -------------------------------------------------------------------------------------------- */
    public function updateProfile(){
        $user = User::where(['status'=>'active','id'=>Auth::user()->id])->first();
        if(empty($user)){
            Notify::error('User not found.');
            return redirect()->to('admin/dashboard');
        }
        return view($this->pageLayout.'updateprofile',compact('user'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Update profile details
    @input: name,email.
    @Output: update profile details
    -------------------------------------------------------------------------------------------- */
    public function updateProfileDetail(Request $request){
        $validatedData = $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email,'.Auth::user()->id,
        ]);
        try{
            $allowedfileExtension=['pdf','jpg','png'];
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('avatar', $file,$filename);
            }else{
                $userDetail=User::where('id',Auth::user()->id)->first()->avatar;
                $filename = $userDetail;
            }
            User::where('id',Auth::user()->id)->update([
                'avatar'    => $filename,
                'name'      => $request->name,
                'email'     => $request->email,
            ]);
            Notify::success('Profile updated successfully !!');
            return redirect()->back();
        }catch(\Exception $e){
            Notify::error($e->getMessage());
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Password
    @input: old_password,password,password_confirmation.
    @Output: update Password
    -------------------------------------------------------------------------------------------- */
    public function updatePassword(Request $request){
        $validatedData = $request->validate([
            'old_password'          => 'required',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ]);
        if (\Hash::check($request->get('old_password'),auth()->user()->password) === false) {
        // The passwords matches
            Notify::error('Your current password does not matches with the password you provided. Please try again.');
            return redirect()->back();
        }
        $user = auth()->user();
        $user->password =\Hash::make($request->get('password'));
        $user->save();
        Notify::success('Password updated successfully !');
        return redirect()->back();
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Referral
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function referral_index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['referral-list']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $users = User::where('user_type','user')->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($users->get())
            ->addIndexColumn()
            ->editColumn('action', function (User $users) {
                $action='';
                $action .='<a href="javascript:void(0);" class="btn btn-info btn-sm user_info" data-id="'.$users->id.'" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                return $action;
            })
            ->editColumn('ref_id', function (User $users) {
                $action = User::where('ref_id', $users->unique_id)->get();
                if(sizeof($action) > 0){
                    return $action->count();
                }else{
                    return '-';
                }
            })
            ->rawColumns(['action','status','ref_id'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name'    => 'name', 'title' => 'Name','width'=>'8%'],
            ['data' => 'unique_id', 'name'    => 'unique_id', 'title' => 'Referral Code','width'=>'8%'],
            ['data' => 'ref_id', 'name'    => 'ref_id', 'title' => 'Total Referral User','width'=>'8%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'8%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'searching'   => true,
        ]);
        return view($this->pageLayout.'user_referral',compact('html'));
    }
    
    /* -----------------------------------------------------------------------------------------
    @Description: Function for Get User Info Data
    @input: id
    @Output: Get User Info Data
    -------------------------------------------------------------------------------------------- */
    public function get_user_info_data($id){
        $tripDetails = User::where('id',$id)->first();
        return response()->json([
            'name'        => $tripDetails->name,
            'email'       => $tripDetails->email,
            'user_type'   => $tripDetails->user_type,
            'status'      => ucfirst($tripDetails->status),
        ]);
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for inquiry index
    @input: inquiry
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function inquiry(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['inquiry-list','inquiry-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['inquiry-delete']);
        $contactus = ContactUs::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($contactus->get())
            ->addIndexColumn()
            ->editColumn('contactlist', function (ContactUs $contactus) {
                return $contactus->country_list->country;
            })
            ->editColumn('message', function (ContactUs $contactus) {
                return mb_strimwidth($contactus->message, 0, 30, " ...");
            })
            ->editColumn('admin_read', function (ContactUs $contactus) {
                if ($contactus->admin_read == "read") {
                    return '<span class="label label-success">Read</span>';
                } else {
                    return '<span class="label label-danger">UnRead</span>';
                }
            })
            ->editColumn('action', function (ContactUs $contactus) use($permission_data) {
                $action = "";
                if($permission_data['hasRemovePermission']){
                    $action .='<a class="btn btn-info btn-sm m-l-10 viewinquiry" data-id ="'.$contactus->id.'" data-toggle="modal" href="javascript:void(0)"><i class="fa fa-eye"></i></a>';
                    $action .='<a class="btn btn-danger btn-sm ml-1 mr-1 deleteinquiry" data-id ="'.$contactus->id.'" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action','message','contactlist','admin_read'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'name', 'name'    => 'name', 'title' => 'User Name','width'=>'10%'],
            ['data' => 'email', 'name'    => 'email', 'title' => 'Email','width'=>'7%'],
            ['data' => 'contact_no', 'name' => 'contact_no', 'title' => 'Contact No','width'=>'5%'],
            ['data' => 'contactlist', 'name' => 'contactlist', 'title' => 'Contact No','width'=>'5%'],
            ['data' => 'message', 'name' => 'message', 'title' => 'message','width'=>'5%'],
            ['data' => 'admin_read', 'name' => 'admin_read', 'title' => 'status','width'=>'5%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'10%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'searching'   => true,
        ]);
        return view($this->pageLayout.'inquiry',compact('html'));  
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for show
    @input: id
    @Output: show inquiry
    -------------------------------------------------------------------------------------------- */
    public function inquiryshow(Request $request){
        ContactUs::where('id',$request->id)->update(['admin_read'  => "read",]);
        $contactus = ContactUs::with(['country_list'])->where('id',$request->id)->first();
        return view($this->pageLayout.'inquiryshow',compact('contactus'));
    }
    
    /* -----------------------------------------------------------------------------------------
    @Description: Function for destroy
    @input: id
    @Output: delete inquiry
    -------------------------------------------------------------------------------------------- */
    public function inquirydelete($id){
        try{
            $userRole = Helper::checkPermission(['inquiry-delete']);
            if(!$userRole){
                $message = "You don't have permission to access this module.";
                return view('error.permission',compact('message'));
            }
            $checkUser = ContactUs::where('id',$id)->first();
            $checkUser->delete();
            Notify::success('Inquiry deleted successfully.');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Inquiry deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}