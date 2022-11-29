<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DataTables,Notify,Validator,Str,Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Builder;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use Mail;

class BlogController extends Controller
{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authLayout = 'front.auth.';
        $this->pageLayout = 'front.pages.blog.';
        //View::share('tenure_values', Setting::where('code','interest_rate_duration')->first('value'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $blog_list = Blog::where('status','active')->orderBy('id','desc')->get();
        return view($this->pageLayout.'index',compact('blog_list'));
    }

    public function blogdetail($id){
        $blog_detail = Blog::where('status','active')->where('id',$id)->first();
        return view($this->pageLayout.'blog_detail',compact('blog_detail'));
    }
}
