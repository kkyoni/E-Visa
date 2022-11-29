<?php
namespace App\Http\Controllers\Admin;
use App\Country;
use App\CountryVisaFee;
use App\CountryWiseVisa;
use App\FromCountry;
use App\User;
use App\VisaType;
use App\VisaTypeEntry;
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

class CountryWiseVisaController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.country_visa.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Country Wise Visa
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['countrywisevisa-list','countrywisevisa-create','countrywisevisa-edit','countrywisevisa-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['countrywisevisa-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['countrywisevisa-edit']);
        $countryvisa = CountryWiseVisa::orderBy('id','desc');
        if (request()->ajax()) {
            return DataTables::of($countryvisa->get())
            ->addIndexColumn()
            ->editColumn('country_id', function (CountryWiseVisa $countryvisa) {
                return $countryvisa->country->country;
            })
            ->editColumn('visa_type_id', function (CountryWiseVisa $countryvisa) {
                return $countryvisa->visatype->visa_type;
            })
            ->editColumn('visa_type_entry_id', function (CountryWiseVisa $countryvisa) {
                if(!empty($countryvisa->visatypeentry)){
                    return $countryvisa->visatypeentry->visa_type_entry;
                }else{
                    return '-';
                }
            })
            ->editColumn('country_from_id', function (CountryWiseVisa $countryvisa) {
                $countries=array();
                $countryname='';
                $allcountry = FromCountry::where('country_visa_id', $countryvisa->id)->get();
                if(!empty($allcountry)){
                    foreach ($allcountry as $country){
                        $countryname = Country::where('id', $country->from_country_id)->first()->country;
                        array_push($countries, $countryname);
                    }
                }
                return implode(', ', $countries);
            })
            ->editColumn('action', function (CountryWiseVisa $countryvisa) use($permission_data) {
                $action = '';
                if($permission_data['hasUpdatePermission']){
                    $action .='<a class="btn btn-info btn-sm ml-1 viewDetail" href="javascript:void(0)" data-id ="'.$countryvisa->id.'" title="View"><i class="fa fa-eye"></i></a>';
                    if($countryvisa->favourite_status == "1"){
                        $action .= '<a class="btn btn-sm btn-start ml-1 start" href="javascript:void(0)" data-id ="'.$countryvisa->id.'" title="Favourite"><i class="fa fa-star" aria-hidden="true"></i></a>';
                    }else{
                        $action .='<a class="btn btn-sm btn-start ml-1 start" href="javascript:void(0)" data-id ="'.$countryvisa->id.'" title="Not Favourite"><i class="fa fa-star-o" aria-hidden="true"></i></a>';
                    }
                    $action .='<a href='.route('admin.country_visa.edit',[$countryvisa->id]).' class="btn btn-warning btn-sm ml-1" title="Edit"><i class="fa fa-edit"></i></a>';
                }
                if($permission_data['hasRemovePermission']){
                    $action .='<a class="btn btn-danger btn-sm ml-1 deletevisacountry" data-id ="'.$countryvisa->id.'" href="javascript:void(0)" title="Delete"><i class="fa fa-trash"></i></a>';
                    $action .='<a class="btn btn-sm btn-success ml-1 addclone" data-id ="'.$countryvisa->id.'" title="Create Clone" href="javascript:void(0)"><i class="fa fa-clone"></i></a>';
                    if($countryvisa->status == "active"){
                        $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 changeStatusRecord" data-id="'.$countryvisa->id.'"><i class="fa fa-unlock"></i></a>';
                    }else{
                        $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 changeStatusRecord" data-id="'.$countryvisa->id.'"><i class="fa fa-lock" ></i></a>';
                    }
                }
                return $action;
            })
            ->editColumn('status', function (CountryWiseVisa $countryvisa) {
                if ($countryvisa->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->rawColumns(['action','status','favourite_status'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'1%',"orderable" => false, "searchable" => false],
            ['data' => 'country_id', 'name' => 'country_id', 'title' => 'Destination Country','width'=>'3%'],
            ['data' => 'visa_type_id', 'name' => 'visa_type_id', 'title' => 'Visa Type','width'=>'2%', "searchable" => false],
            ['data' => 'country_from_id', 'name' => 'country_from_id', 'title' => 'Country From','width'=>'1%', "searchable" => false],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status','width'=>'1%', "searchable" => false],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'5%',"orderable" => false, "searchable" => false],
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
    @Description: Function for Country Wise Visa Status
    @input: Country Wise Visa
    @Output: Status Country Wise Visa Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $countrywisevisa = CountryWiseVisa::where('id',$request->id)->first();
            if($countrywisevisa === null){
                return redirect()->back()->with([
                    'status'    => 'warning',
                    'title'     => 'Warning!!',
                    'message'   => 'User not found !!'
                ]);
            }else{
                if($countrywisevisa->status == "active"){
                    CountryWiseVisa::where('id',$request->id)->update([
                        'status' => "inactive",
                    ]);
                }
                if($countrywisevisa->status == "inactive"){
                    CountryWiseVisa::where('id',$request->id)->update([
                        'status'=> "active",
                    ]);
                }
            }
            Notify::success('Country Wise Visa status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Country Wise Visa status updated successfully.'
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
    @Description: Function for create page view
    @input: Country Wise Visa
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
        $userRole = Helper::checkPermission(['countrywisevisa-create']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        $visa_type_entries = VisaTypeEntry::pluck('visa_type_entry','id');
        $country_from = Country::get();
        $countryvisa=$countryvisafee_list=array();
        return view($this->pageLayout.'create', compact('country_list','visa_types','visa_type_entries','country_from','countryvisa','countryvisafee_list'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Country Wise Visa data
    @input: Country Wise Visa
    @Output: store Country Wise Visa data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $validatedData = Validator::make($request->all(),[
            'country_id'              => 'required',
            'visa_type_id'            => 'required',
            'country_from_id'         => 'required',
            // 'regular_service_type'    => 'required',
            'information'             => 'required',
            'required_docs'           => 'required',
            'visa_type_entry_id'       => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            $countrywisevisa = CountryWiseVisa::create([
                'visa_type_id'  => @$request->get('visa_type_id'),
                'country_id'    => @$request->get('country_id'),
                'information'   => @$request->get('information'),
                'required_docs' => @$request->get('required_docs'),
                'status'        => @$request->get('status'),
            ]);
            if(isset($request->country_from_id)){
                foreach ($request->country_from_id as $item) {
                    $countryid = Country::where('country', $item)->orWhere('id', $item)->first();
                    if(!empty($countryid)){
                        FromCountry::create([
                            'country_visa_id' => $countrywisevisa->id,
                            'from_country_id' => $countryid->id,
                        ]);
                    }
                }
            }
            if(isset($request->visa_type_entry_id)){
                foreach ($request->visa_type_entry_id as $key => $value) {
                    if($value){
                        CountryVisaFee::create([
                            'country_visa_id'       => $countrywisevisa->id,
                            'visa_type_entry_id'    => @$value,
                            'regular_gov_fee'       => @$request->get('regular_gov_fee')[$key],
                            // 'regular_service_type'  => @$request->get('regular_service_type')[$key],
                            'visa_validity'         => @$request->get('visa_validity')[$key],
                            'stay_validity'         => @$request->get('stay_validity')[$key],
                            'service_fee'           => @$request->get('service_fee')[$key],
                            'processing_day'        => @$request->get('processing_day')[$key],
                        ]);
                    }
                }
            }
            Notify::success('Country Wise Visa Created Successfully.');
            return redirect()->route('admin.country_visa.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Country Wise Visa
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit(CountryWiseVisa $countryvisa, $id){
        $userRole = Helper::checkPermission(['countrywisevisa-edit']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $countryvisa = CountryWiseVisa::with(['visatype','visatypeentry','country','country_from','from_country'])->where('id', $id)->first();
        $country_list = Country::pluck('country','id');
        $visa_types = VisaType::pluck('visa_type','id');
        $visa_type_entries = VisaTypeEntry::pluck('visa_type_entry','id');
        $country_from = Country::get();
        $fromcountry_list = FromCountry::where('country_visa_id', $id)->pluck('from_country_id','id');
        $countryvisafee_list = CountryVisaFee::where('country_visa_id', $id)->get();
        return view($this->pageLayout.'edit', compact('country_list','countryvisa','visa_types','visa_type_entries','country_from','fromcountry_list','countryvisafee_list'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Country Wise Visa data
    @input: Country Wise Visa
    @Output: Update Country Wise Visa data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, CountryWiseVisa $countryvisa, $id){
        $validatedData = Validator::make($request->all(),[
            'country_id'              => 'required',
            'visa_type_id'            => 'required',
            'country_from_id'         => 'required',
            // 'regular_service_type'    => 'required',
            'information'             => 'required',
            'required_docs'           => 'required',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            CountryWiseVisa::where('id',$id)->update([
                'visa_type_id'   => @$request->get('visa_type_id'),
                'country_id'     => @$request->get('country_id'),
                'information'    => @$request->get('information'),
                'required_docs'  => @$request->get('required_docs'),
                'status'         => @$request->get('status'),
            ]);
            // dd($request->country_from_id);

            if(isset($request->country_from_id)){
                FromCountry::where('country_visa_id', $id)->forceDelete();
                foreach ($request->country_from_id as $item) {
                    $countryid = Country::where('country', $item)->orWhere('id', $item)->first();
                    if(!empty($countryid)){
                        FromCountry::create([
                            'country_visa_id' => $id,
                            'from_country_id' => $countryid->id,
                        ]);
                    }
                }
                // die();
            }
            if(isset($request->visa_type_entry_id)){
                CountryVisaFee::where('country_visa_id', $id)->forceDelete();
                foreach ($request->visa_type_entry_id as $key => $value) {
                    if($value){
                        CountryVisaFee::create([
                            'country_visa_id'       => $id,
                            'visa_type_entry_id'    => @$value,
                            'regular_gov_fee'       => @$request->get('regular_gov_fee')[$key],
                            // 'regular_service_type'  => @$request->get('regular_service_type')[$key],
                            'visa_validity'         => @$request->get('visa_validity')[$key],
                            'stay_validity'         => @$request->get('stay_validity')[$key],
                            'service_fee'           => @$request->get('service_fee')[$key],
                            'processing_day'       => @$request->get('processing_day')[$key],
                        ]);
                    }
                }
            }
            Notify::success('Country Wise Visa Updated Successfully.');
            return redirect()->route('admin.country_visa.index');
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
    @Output: delete Country Wise Visa
    -------------------------------------------------------------------------------------------- */
    public function delete(CountryWiseVisa $countryvisa, $id){
        $userRole = Helper::checkPermission(['countrywisevisa-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        try{
            CountryWiseVisa::where('id', $id)->delete();
            CountryVisaFee::where('country_visa_id', $id)->delete();
            FromCountry::where('country_visa_id', $id)->delete();
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Country Wise Visa deleted successfully.'
            ]);
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for show
    @input: id
    @Output: show Country Wise Visa
    -------------------------------------------------------------------------------------------- */
    public function show(Request $request) {
        $details = CountryWiseVisa::with('country','visatype','visatypeentry','country_from','from_country','countryvisafee')->where('id',$request->id)->first();
        return view($this->pageLayout.'view',compact('details'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Show Country Visa
    @input: id
    @Output: Get Show Country Wise Visa
    -------------------------------------------------------------------------------------------- */
    public function ShowCountryVisa($id){
        $details = CountryWiseVisa::with('country','visatype','visatypeentry','country_from','from_country','countryvisafee')->where('id',$id)->first();
        $from_country='';
        if(!empty($details)){
            $from_country='';
            if(!empty($details->from_country)){
                $countries=array();
                $countryname='';
                foreach ($details->from_country as $country){
                    $countryname = Country::where('id', $country->from_country_id)->first()->country;
                    array_push($countries, $countryname);
                }
                $from_country = implode(', ', $countries);
            }
        }
        return response()->json([
            'country'                   => @$details['country']->country,
            'visatype'                  => @$details['visatype']->visa_type,
            'visa_validity'             => @$details->visa_validity,
            'stay_validity'             => @$details->stay_validity,
            'regular_service_cost'      => @$details->regular_service_cost,
            'express_service_cost'      => @$details->express_service_cost,
            'express_gov_fee'           => @$details->express_gov_fee,
            'regular_gov_fee'           => @$details->regular_gov_fee,
            // 'regular_service_type'      => @$details->regular_service_type,
            'express_service_type'      => @$details->express_service_type,
            'information'               => @$details->information,
            'required_docs'             => @$details->required_docs,
            'status'                    => @$details->status,
            'country_from'              => @$from_country,
        ]);
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Create clone
    @input: id
    @Output: clone Country Wisw Visa 
    -------------------------------------------------------------------------------------------- */
    public function createclone(Request $request, $id){
        $details = CountryWiseVisa::with('country','visatype','visatypeentry','country_from','from_country','countryvisafee')->where('id',$id)->first();
        if(!empty($details)){
            $countrywisevisa = CountryWiseVisa::create([
                'visa_type_id'          => @$details->visa_type_id,
                'country_id'            => @$details->country_id,
                'visa_validity'         => @$details->visa_validity,
                'stay_validity'         => @$details->stay_validity,
                'regular_service_cost'  => @$details->regular_service_cost,
                'express_service_cost'  => @$details->express_service_cost,
                // 'regular_service_type'  => @$details->regular_service_type,
                'express_service_type'  => @$details->express_service_type,
                'information'           => @$details->information,
                'required_docs'         => @$details->required_docs,
                'status'                => @$details->status,
            ]);
            if(!empty($details->from_country)){
                foreach ($details->from_country as $item) {
                    FromCountry::create([
                        'country_visa_id'    => $countrywisevisa->id,
                        'from_country_id'    => $item->from_country_id,
                    ]);
                }
            }
            if(!empty($details->countryvisafee)){
                foreach ($details->countryvisafee as $key => $value) {
                    if($value){
                        CountryVisaFee::create([
                            'country_visa_id'       => $countrywisevisa->id,
                            'visa_type_entry_id'    => @$value->visa_type_entry_id,
                            'regular_gov_fee'       => @$value->regular_gov_fee,
                            'express_gov_fee'       => @$value->express_gov_fee,
                            // 'regular_service_type'  => @$value->regular_service_type,
                            'visa_validity'         => @$value->visa_validity,
                            'stay_validity'         => @$value->stay_validity,
                            'service_fee'           => @$value->service_fee,
                            'processing_time'       => @$value->processing_time,
                        ]);
                    }
                }
            }
        }
        return response()->json([
            'status_code'=>'200',
            'success'=>true
        ]);
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for favourite status
    @input: id
    @Output: favourite Status Country Wise Visa
    -------------------------------------------------------------------------------------------- */
    public function start(Request $request){
        try{
            $countryvisa = CountryWiseVisa::where('id',$request->id)->first();
            if($countryvisa === null){
                return redirect()->back()->with([
                    'status'    => 'warning',
                    'title'     => 'Warning!!',
                    'message'   => 'User not found !!'
                ]);
            }else{
                if($countryvisa->favourite_status == "1"){
                    CountryWiseVisa::where('id',$request->id)->update([
                        'favourite_status' => "0",
                    ]);
                }
                if($countryvisa->favourite_status == "0"){
                    CountryWiseVisa::where('id',$request->id)->update([
                        'favourite_status'=> "1",
                    ]);
                }
            }
            Notify::success('Country Wise Visa Favourite updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Country Wise Visa Favourite updated successfully.'
            ]);
        }catch (Exception $e){
            return response()->json([
                'status'    => 'error',
                'title'     => 'Error!!',
                'message'   => $e->getMessage()
            ]);
        }
    }
}