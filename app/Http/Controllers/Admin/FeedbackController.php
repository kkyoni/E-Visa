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
use App\Feedback;
use Event;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Settings;
use App\Helpers\Helper;

class FeedbackController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.feedback.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Feed Back
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request)
    {
    // role ane permission check
        $userRole = '';
        $userRole = Helper::checkPermission(['feedback-list']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['price-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['price-edit']);
        // role ane permission check
        $feedback = Feedback::with('user_detail')->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($feedback->get())
            ->addIndexColumn()
            ->editColumn('user_id', function (Feedback $feedback) {
                return $feedback->user_detail->name;
            })
            ->editColumn('rating', function (Feedback $feedback) {
                if($feedback->rating == "5"){
                    return "<span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>";
                }elseif($feedback->rating == "4"){
                    return "<span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>";
                }elseif($feedback->rating == "3"){
                    return "<span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>";
                }elseif($feedback->rating == "2"){
                    return "<span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>";
                }elseif($feedback->rating == "1"){
                    return "<span class='glyphicon glyphicon-star' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>";
                } else {
                    return "<span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>
                    <span class='glyphicon glyphicon-star-empty' style='color: #f15f39; font-size: 20px;'></span>";
                }
            })
            ->editColumn('review', function (Feedback $feedback) {
                return mb_strimwidth($feedback->review, 0, 80, " ...");
            })
            ->rawColumns(['user_id','review','rating'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'user_id', 'name'    => 'user_id', 'title' => 'User Name','width'=>'18%'],
            ['data' => 'rating', 'name'    => 'rating', 'title' => 'Rating','width'=>'8%'],
            ['data' => 'review', 'name'    => 'review', 'title' => 'Review','width'=>'8%'],
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
}