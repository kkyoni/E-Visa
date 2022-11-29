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
use App\Script;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;

class ScriptController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.script.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Script
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(){
    // role ane permission check
        $userRole = Helper::checkPermission(['script-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        // role ane permission check
        $id = 1;
        $script = Script::find($id);
        if ($script) {
            return view($this->pageLayout . 'index', compact('script', 'id'));
        }
        return redirect()->to('admin/dashboard');
    }
    
    /* -----------------------------------------------------------------------------------------
    @Description: Function for update script data
    @input: script
    @Output: Update Email script data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, $id){
        $userRole = Helper::checkPermission(['script-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        try{
            $script = Script::where('id', $id)->update([
                'header_script'         => @$request->get('header_script'),
                'body_script'           => @$request->get('body_script'),
                'footer_script'         => @$request->get('footer_script'),
            ]);
            Notify::success('Script Updated Successfully.');
            return redirect()->route('admin.script.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }
}