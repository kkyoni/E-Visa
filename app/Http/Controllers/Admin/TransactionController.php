<?php
namespace App\Http\Controllers\Admin;
use App\Transaction;
use App\User;
use App\VisaApplicant;
use App\VisaType;
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

class TransactionController extends Controller{
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
        $this->pageLayout = 'admin.pages.transactions.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Transaction
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['transaction-list']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $transactions = Transaction::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($transactions->get())
                ->addIndexColumn()
                ->editColumn('action', function (Transaction $transactions) {
                    $action = '';
                    $action .='<a class="btn btn-sm btn-warning" href=""><i class="fa fa-eye"></i></a>';
                    return $action;
                })
                ->editColumn('user_id', function (Transaction $transactions) {
                    return $transactions->user->name;
                })
                ->editColumn('order_id', function (Transaction $transactions) {
                    return $transactions->visa_application->application_no;
                })
                ->editColumn('action', function (Transaction $transactions){
                $action = '';
                $action .='<a class="btn btn-info btn-sm m-l-10 viewtransactions" data-id ="'.$transactions->id.'" data-toggle="modal" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                return $action;
            })
                ->rawColumns(['action','payment_status'])
                ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'3%',"orderable" => false, "searchable" => false],
            ['data' => 'order_id', 'name' => 'order_id', 'title' => 'Order Id','width'=>'3%'],
            ['data' => 'transaction_id', 'name' => 'transaction_id', 'title' => 'Transaction Id','width'=>'4%'],
            ['data' => 'user_id', 'name' => 'user_id', 'title' => 'User Name','width'=>'5%'],
            ['data' => 'payment_type', 'name' => 'payment_type', 'title' => 'Payment Type','width'=>'5%'],
            ['data' => 'payment_status', 'name' => 'payment_status', 'title' => 'Payment Status','width'=>'5%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'3%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => true,
            'searchDelay' => 350,
            'dom'         => 'lBfrtip',
            'buttons'     => [
                ['extend' => 'print','title' => "Transaction Report", 'text' => '<i class="fa fa-print" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
                ['extend' => 'excel','title' => "Transaction Report", 'text' => '<i class="fa fa-file-excel-o" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
                ['extend' => 'pdf','title' => "Transaction Report", 'text' => '<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
            ],
            'searching'   => true,
        ]);
        $roles = Role::pluck('name','id');
        \View::share('roles',$roles);
        return view($this->pageLayout.'index',compact('html'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for show
    @input: id
    @Output: show Transaction
    -------------------------------------------------------------------------------------------- */
    public function show(Request $request){
        $transaction = Transaction::with(['visa_application','user'])->where('id',$request->id)->first();
        return view($this->pageLayout.'show',compact('transaction'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Approval Transaction
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function visa_approval_index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['transaction-list']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $transactions = Transaction::where('payment_status','success')->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($transactions->get())
            ->addIndexColumn()
            ->editColumn('action', function (Transaction $transactions) {
                $action = '';
                $action .='<a class="btn btn-sm btn-warning" href=""><i class="fa fa-eye"></i></a>';
                return $action;
            })
            ->editColumn('user_id', function (Transaction $transactions) {
                return $transactions->user->name;
            })
            ->editColumn('order_id', function (Transaction $transactions) {
                return $transactions->visa_application->application_no;
            })
            ->editColumn('action', function (Transaction $transactions){
                $action = '';
                $action .='<a class="btn btn-info btn-sm m-l-10 viewapprovaltransactions" data-id ="'.$transactions->id.'" data-toggle="modal" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                return $action;
            })
            ->rawColumns(['action','payment_status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'order_id', 'name' => 'order_id', 'title' => 'Order Id','width'=>'6%'],
            ['data' => 'transaction_id', 'name' => 'transaction_id', 'title' => 'Transaction Id','width'=>'6%'],
            ['data' => 'user_id', 'name' => 'user_id', 'title' => 'User Name','width'=>'6%'],
            ['data' => 'payment_type', 'name' => 'payment_type', 'title' => 'Payment Type','width'=>'5%'],
            ['data' => 'payment_status', 'name' => 'payment_status', 'title' => 'Payment Status','width'=>'5%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'8%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'dom'         => 'lBfrtip',
            'buttons'     => [
                ['extend' => 'print','title' => "Visa Approval Report", 'text' => '<i class="fa fa-print" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
                ['extend' => 'excel','title' => "Visa Approval Report", 'text' => '<i class="fa fa-file-excel-o" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
                ['extend' => 'pdf','title' => "Visa Approval Report", 'text' => '<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
            ],
            'searching'   => true,
        ]);
        $roles = Role::pluck('name','id');
        \View::share('roles',$roles);
        return view($this->pageLayout.'visa_approval_index',compact('html'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for show
    @input: id
    @Output: show Approval
    -------------------------------------------------------------------------------------------- */
    public function approvalshow(Request $request){
        $transaction = Transaction::with(['visa_application','user'])->where('id',$request->id)->first();
        return view($this->pageLayout.'show_approval',compact('transaction'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Reject Transaction
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function visa_reject_index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['transaction-list']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $transactions = Transaction::where('payment_status','reject')->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($transactions->get())
            ->addIndexColumn()
            ->editColumn('action', function (Transaction $transactions) {
                $action = '';
                $action .='<a class="btn btn-sm btn-warning" href=""><i class="fa fa-eye"></i></a>';
                return $action;
            })
            ->editColumn('user_id', function (Transaction $transactions) {
                return $transactions->user->name;
            })
            ->editColumn('order_id', function (Transaction $transactions) {
                return $transactions->visa_application->application_no;
            })
            ->editColumn('action', function (Transaction $transactions){
                $action = '';
                $action .='<a class="btn btn-info btn-sm m-l-10 viewrejecttransactions" data-id ="'.$transactions->id.'" data-toggle="modal" href="javascript:void(0)" title="View"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;';
                return $action;
            })
            ->rawColumns(['action','payment_status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'order_id', 'name' => 'order_id', 'title' => 'Order Id','width'=>'6%'],
            ['data' => 'transaction_id', 'name' => 'transaction_id', 'title' => 'Transaction Id','width'=>'6%'],
            ['data' => 'user_id', 'name' => 'user_id', 'title' => 'User Name','width'=>'6%'],
            ['data' => 'payment_type', 'name' => 'payment_type', 'title' => 'Payment Type','width'=>'5%'],
            ['data' => 'payment_status', 'name' => 'payment_status', 'title' => 'Payment Status','width'=>'5%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'8%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'dom'         => 'lBfrtip',
            'buttons'     => [
                ['extend' => 'print','title' => "Visa Reject Report", 'text' => '<i class="fa fa-print" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
                ['extend' => 'excel','title' => "Visa Reject Report", 'text' => '<i class="fa fa-file-excel-o" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
                ['extend' => 'pdf','title' => "Visa Reject Report", 'text' => '<i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size:16px"></i>','exportOptions' => ['columns'=> [0,1,2,3,4,5]]],
            ],
            'searching'   => true,
        ]);
        $roles = Role::pluck('name','id');
        \View::share('roles',$roles);
        return view($this->pageLayout.'visa_reject_index',compact('html'));
    }
    
    /* -----------------------------------------------------------------------------------------
    @Description: Function for show
    @input: id
    @Output: Reject Approval
    -------------------------------------------------------------------------------------------- */
    public function rejectshow(Request $request){
        $transaction = Transaction::with(['visa_application','user'])->where('id',$request->id)->first();
        return view($this->pageLayout.'show_reject',compact('transaction'));
    }
}