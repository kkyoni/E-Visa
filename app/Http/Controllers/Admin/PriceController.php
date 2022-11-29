<?php
namespace App\Http\Controllers\Admin;
use App\Price;
use App\VisaType;
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

class PriceController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.prices.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Prices
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['price-list','price-create','price-edit','price-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['price-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['price-edit']);
        $prices = Price::with(['visatype','country_list'])->orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($prices->get())
            ->addIndexColumn()
            ->editColumn('country_id', function (Price $prices) {
                return $prices->country_list->country;
            })
            ->editColumn('visa_type_id', function (Price $prices) {
                return $prices->visatype->visa_type;
            })
            ->editColumn('status', function (Price $prices) {
                return ucfirst($prices->status);
            })
            ->editColumn('action', function (Price $prices) use($permission_data) {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a href='.route('admin.prices.edit',[$prices->id]).' class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                }
                if($permission_data['hasRemovePermission']){
                    $action .='<a class="btn btn-danger btn-sm m-l-10 deleteprice" data-id ="'.$prices->id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'country_id', 'name'    => 'country_id', 'title' => 'Country','width'=>'15%'],
            ['data' => 'visa_type_id', 'name'    => 'visa_type_id', 'title' => 'Visa Type','width'=>'10%'],
            ['data' => 'amount', 'name'    => 'amount', 'title' => 'Amount (in %)','width'=>'10%'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'9%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'8%',"orderable" => false, "searchable" => false],
        ])
        ->parameters([
            'order' =>[],
            'paging'      => true,
            'info'        => false,
            'searchDelay' => 350,
            'searching'   => true,
        ]);
        $visa_types = VisaType::pluck('visa_type','id');
        return view($this->pageLayout.'index',compact('html','visa_types'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for create page view
    @input: Prices
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
        $userRole = Helper::checkPermission(['price-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        $prices=array();
        return view($this->pageLayout.'create',compact('country_list','prices','visa_types'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Prices data
    @input: Prices
    @Output: store Prices data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'country_id'      => 'required',
            'visa_type_id'    => 'required',
            'amount'          => 'required',
            'status'          => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $checkprice = Price::where('country_id', $request->country_id)->where('visa_type_id', $request->visa_type_id)->where('status', $request->status)->first();
            if(!empty($checkprice)){
                Notify::error('Price Already Created.');
                return back();
            }else{
                Price::create([
                    'country_id'      => $request->country_id,
                    'visa_type_id'    => $request->visa_type_id,
                    'amount'          => $request->amount,
                    'status'          => $request->status,
                ]);
                Notify::success('Price Created Successfully.');
                return redirect()->route('admin.prices.index');
            }
        }catch(\Exception $e){
            return back()-> with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Prices
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
        $userRole = Helper::checkPermission(['price-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        $prices = Price::with(['visatype','country_list'])->where('id', $id)->first();
        return view($this->pageLayout.'edit',compact('country_list','prices','visa_types'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Prices data
    @input: Prices
    @Output: Update Prices data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, $id){
        $validatedData = Validator::make($request->all(),[
            'country_id'      => 'required',
            'visa_type_id'    => 'required',
            'amount'          => 'required',
            'status'          => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            Price::where('id', $id)->update([
                'country_id'      => $request->country_id,
                'visa_type_id'    => $request->visa_type_id,
                'amount'          => $request->amount,
                'status'          => $request->status,
            ]);
            Notify::success('Price Updated Successfully.');
            return redirect()->route('admin.prices.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Prices Status
    @input: Prices
    @Output: Status Prices Change
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

    /* -----------------------------------------------------------------------------------------
    @Description: Function for destroy
    @input: id
    @Output: delete Prices
    -------------------------------------------------------------------------------------------- */
    public function delete(Embassy $embassy, $id){
        try{
            Price::where('id', $id)->delete();
            Notify::success('Price Deleted Successfully.');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Price Deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Prices For status index
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function status_index(Builder $builder, Request $request, $id){
        $prices = Price::with(['visatype','country_list'])->where('status', $id)->orderBy('id','desc');
        $status = '';
        if (request()->ajax()) {
            return DataTables::of($prices->get())
            ->addIndexColumn()
            ->editColumn('country_id', function (Price $prices) {
                return $prices->country_list->country;
            })
            ->editColumn('visa_type_id', function (Price $prices) {
                return $prices->visatype->visa_type;
            })
            ->editColumn('status', function (Price $prices) {
                return ucfirst($prices->status);
            })
            ->editColumn('action', function (Price $prices) {
                $action = '';
                $action .='<a href='.route('admin.prices.edit',[$prices->id]).' class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                $action .='<a class="btn btn-sm btn-danger m-l-10 deleteprice" data-id ="'.$prices->id.'" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'country_id', 'name'    => 'country_id', 'title' => 'Country','width'=>'15%'],
            ['data' => 'visa_type_id', 'name'    => 'visa_type_id', 'title' => 'Visa Type','width'=>'15%'],
            ['data' => 'amount', 'name'    => 'amount', 'title' => 'Amount','width'=>'15%'],
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
        $visa_types = VisaType::pluck('visa_type','id');
        $checkstatus=$id;
        return view($this->pageLayout.'index',compact('html','visa_types','checkstatus'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Prices For Visa Type index
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function visatype_index(Builder $builder, Request $request, $id){
        $prices = Price::with(['visatype','country_list'])->where('visa_type_id', $id)->orderBy('id','desc');
        $visatypeid=$id;
        if (request()->ajax()) {
            return DataTables::of($prices->get())
            ->addIndexColumn()
            ->editColumn('country_id', function (Price $prices) {
                return $prices->country_list->country;
            })
            ->editColumn('visa_type_id', function (Price $prices) {
                return $prices->visatype->visa_type;
            })
            ->editColumn('status', function (Price $prices) {
                return ucfirst($prices->status);
            })
            ->editColumn('action', function (Price $prices) {
                $action = '';
                $action .='<a href='.route('admin.prices.edit',[$prices->id]).' class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
                $action .='<a class="btn btn-sm btn-danger m-l-10 deleteprice" data-id ="'.$prices->id.'" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
                return $action;
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'5%',"orderable" => false, "searchable" => false],
            ['data' => 'country_id', 'name'    => 'country_id', 'title' => 'Country','width'=>'15%'],
            ['data' => 'visa_type_id', 'name'    => 'visa_type_id', 'title' => 'Visa Type','width'=>'15%'],
            ['data' => 'amount', 'name'    => 'amount', 'title' => 'Amount','width'=>'15%'],
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
        $visa_types = VisaType::pluck('visa_type','id');
        return view($this->pageLayout.'index',compact('html','visa_types','visatypeid'));
    }
}