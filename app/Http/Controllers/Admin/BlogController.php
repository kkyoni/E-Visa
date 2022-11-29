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
use App\Blog;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;

class BlogController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.blog.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Blog
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
    $userRole = '';
    $userRole = Helper::checkPermission(['blog-list','blog-create','blog-edit','blog-delete']);
    if(!$userRole){
        $message = "You don't have permission to access this module.";
        return view('error.permission',compact('message'));
    }
    $permission_data['hasRemovePermission'] = Helper::checkPermission(['blog-delete']);
    $permission_data['hasUpdatePermission'] = Helper::checkPermission(['blog-edit']);
    $blog = Blog::orderBy('id','desc');
    if (request()->ajax()) {
        return DataTables::of($blog->get())
        ->addIndexColumn()
        ->editColumn('status', function (Blog $blog) {
            if ($blog->status == "active") {
                return '<span class="label label-success">Active</span>';
            } else {
                return '<span class="label label-danger">Inactive</span>';
            }
        })
        ->editColumn('blog', function (Blog $blog){
            if(!$blog->blog){
                return '<img class="img-thumbnail" src="' . asset('storage/blog/default.png').'" width="60px">';
            }else{
                return '<img class="img-thumbnail" src="' . asset('storage/blog' . '/' . $blog->blog) . '" width="60px">';
            }
        })
        ->editColumn('description', function (Blog $blog) {
            return Str::words($blog->description, 4,'....');
        })
        ->editColumn('action', function (Blog $blog) use($permission_data) {
            $action = '';
            if($permission_data['hasUpdatePermission']){
                $action .='<a class="btn btn-warning btn-sm" href='.route('admin.blog.edit',[$blog->id]).' title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
            }
            if($blog->status == "active"){
                $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$blog->id.'" title="Active"><i class="fa fa-unlock"></i></a>';
            }else{
                $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$blog->id.'" title="Block"><i class="fa fa-lock"></i></a>';
            }
            if($permission_data['hasRemovePermission']){
                $action .='<a class="btn btn-danger btn-sm ml-1 mr-1 deleteblog" data-id ="'.$blog->id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
            }
            return $action;
        })
        ->rawColumns(['blog','action','status','description'])
        ->make(true);
    }
    $html = $builder->columns([
        ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
        ['data' => 'blog', 'name'    => 'blog', 'title' => 'blog','width'=>'10%',"orderable" => false, "searchable" => false],
        ['data' => 'title', 'name'    => 'title', 'title' => 'Title','width'=>'15%'],
        ['data' => 'description', 'name'    => 'description', 'title' => 'Description','width'=>'15%'],
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
    @input: Blog
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
        $userRole = Helper::checkPermission(['blog-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        return view($this->pageLayout.'create');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Blog data
    @input: Blog
    @Output: store Blog data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'title'             => 'required|unique:blog,title,NULL,id,deleted_at,NULL',
            'description'       => 'required',
            'status'            => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            if($request->hasFile('blog')){
                $file = $request->file('blog');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('blog', $file,$filename);
            }else{
                $filename = 'blog.png';
            }
            Blog::create([
                'blog'            => @$filename,
                'title'           => @$request->get('title'),
                'description'     => @$request->get('description'),
                'status'          => @$request->get('status'),
            ]);
            Notify::success('Blog Created Successfully.');
            return redirect()->route('admin.blog.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Blog
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
        $userRole = Helper::checkPermission(['blog-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $blog = Blog::find($id);
        return view($this->pageLayout.'edit',compact('blog','id'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Blog data
    @input: Blog
    @Output: Update Blog data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request,$id){
        $validatedData = Validator::make($request->all(),[
            'title'             => 'required|unique:blog,title,'.$id.',id,deleted_at,NULL',
            'description'       => 'required',
            'status'            => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $oldDetails = Blog::find($id);
            if($request->hasFile('blog')){
                $file = $request->file('blog');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('blog', $file,$filename);
            }else{
                if($oldDetails->blog !== null){
                    $filename = $oldDetails->blog;
                }else{
                    $filename = 'blog.png';
                }
            }
            Blog::where('id',$id)->update([
                'title'           => @$request->get('title'),
                'blog'            => @$filename,
                'description'     => @$request->get('description'),
                'status'          => @$request->get('status'),
            ]);
            Notify::success('Blog Updated Successfully.');
            return redirect()->route('admin.blog.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Blog Status
    @input: Blog
    @Output: Status Blog Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $blog = Blog::where('id',$request->id)->first();
            if($blog->status == "active"){
                Blog::where('id',$request->id)->update([
                    'status' => "block",
                ]);
            }else{
                Blog::where('id',$request->id)->update([
                    'status'=> "active",
                ]);
            }
            Notify::success('Blog status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Blog status updated successfully.'
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
    @Output: delete Blog
    -------------------------------------------------------------------------------------------- */
    public function delete(Blog $blog, $id){
        $userRole = Helper::checkPermission(['blog-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        try{
            Blog::where('id', $id)->delete();
            Notify::success('Blog Deleted Successfully.');
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
}