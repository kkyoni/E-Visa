<?php
namespace App\Http\Controllers\Admin;
use App\CountryVisaFee;
use App\CountryWiseVisa;
use App\Faq;
use App\FromCountry;
use App\Http\Controllers\Controller;
use App\Country;
use App\Price;
use App\User;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Http\Request;
use Auth;
use App\Language,App\UserCountry;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller{
    protected $authLayout = '';
    protected $pageLayout = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->authLayout = 'admin.auth.';
        $this->pageLayout = 'admin.pages.country.';
        $this->middleware('auth');
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for index
    @input: Country
    @Output: Details data view
    -------------------------------------------------------------------------------------------- */
    public function index(Builder $builder, Request $request){
        $userRole = '';
        $userRole = Helper::checkPermission(['country-list','country-create','country-edit','country-delete']);
        if(!$userRole){
            $message = "You don't have permission to access this module.";
            return view('error.permission',compact('message'));
        }
        $permission_data['hasRemovePermission'] = Helper::checkPermission(['country-delete']);
        $permission_data['hasUpdatePermission'] = Helper::checkPermission(['country-edit']);
        $country = Country::latest()->get();
        if (request()->ajax()) {
            return DataTables::of($country)
            ->addIndexColumn()
            ->editColumn('image', function (Country $country){
                if(!$country->image){
                    return '<img class="img-thumbnail" src="' . asset('storage/country_flag/default.png').'" width="60px">';
                }else{
                    return '<img class="img-thumbnail" src="' . asset('storage/country_flag' . '/' . $country->image) . '" width="60px">';
                }
            })
            ->editColumn('status', function (Country $country) {
                if ($country->status == "active") {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->editColumn('action', function (Country $country) use($permission_data){
                $action = $delete = '';
                $checkvisaforprice = Price::where('country_id', $country->id)->first();
                $checkcountryvisa = FromCountry::where('from_country_id', $country->id)->first();
                $checkfaqvisa = Faq::where('country_id', $country->id)->first();
                if($permission_data['hasUpdatePermission']){
                    $action .= '<a href='.route('admin.country.edit',[$country->id]).' class="btn btn-warning btn-sm ml-1 mr-1 "data-id ="'.$country->id.'" title="Edit"><i class="fa fa-pencil"></i></a>';
                }
                if($permission_data['hasRemovePermission']){
                    if(empty($checkvisaforprice) && empty($checkcountryvisa) && empty($checkfaqvisa)){
                        $action .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm ml-1 mr-1 deletecountry" data-id ="'.$country->id.'" title="Delete"><i class="fa fa-trash"></i></a>';
                    }
                }
                if($country->status == "active"){
                    $action .= '<a href="javascript:void(0)" data-value="1"   data-toggle="tooltip" title="Active" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$country->id.'"><i class="fa fa-unlock"></i></a>';
                }else{
                    $action .= '<a href="javascript:void(0)" data-value="0"  data-toggle="tooltip" title="Block" class="btn btn-sm btn-dark ml-1 mr-1 changeStatusRecord" data-id="'.$country->id.'"><i class="fa fa-lock" ></i></a>';
                }
                return $action;
            })
            ->rawColumns(['action','status','image'])
            ->make(true);
        }
        $html = $builder->columns([
            ['data' => 'DT_RowIndex', 'name' => '', 'title' => 'Sr no','width'=>'2%',"orderable" => false, "searchable" => false],
            ['data' => 'country', 'name'    => 'country', 'title' => 'Country','width'=>'7%'],
            ['data' => 'service_tax_fee', 'name'    => 'service_tax_fee', 'title' => 'Tax on Service Fee (in %)','width'=>'5%'],
            ['data' => 'image', 'name'    => 'image', 'title' => 'Images','width'=>'5%'],
            ['data' => 'status', 'name'    => 'status', 'title' => 'Status','width'=>'3%'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action','width'=>'15%',"orderable" => false],
        ])
        ->parameters([
            'order' =>[],
        ]);
        return view($this->pageLayout.'index',compact('html'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for edit
    @input: Country
    @Output: edit data view
    -------------------------------------------------------------------------------------------- */
    public function edit($id){
        $operator = User::find($id);
        $country = Country::find($id);
        return view($this->pageLayout.'edit',compact('operator','id','country'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for create page view
    @input: Country
    @Output: create page view
    -------------------------------------------------------------------------------------------- */
    public function create(){
        $country=array();
        return view($this->pageLayout.'create', compact('country'));
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for store Country data
    @input: Country
    @Output: store Country data
    -------------------------------------------------------------------------------------------- */
    public function store(Request $request){
        $input = $request->except(['_token']);
        $data = $request->except(['_token','_method']);
        $validatedData = Validator::make($input,[
            'country'           => 'required|unique:country,country,NULL,id,deleted_at,NULL',
            'service_tax_fee'   => 'required|numeric',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);
        if($validatedData->fails()){
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        try{
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::random(10).$file->getClientOriginalName();
                Storage::disk('public')->putFileAs('/country_flag',$file,$filename);
            }else{
                $filename = 'default.png';
            }
            $country=Country::create([
                'country'           => @$request->get('country'),
                'service_tax_fee'   => @$request->get('service_tax_fee'),
                'image'             => @$filename,
            ]);
            Notify::success('Country Created Successfully.');
            return redirect()->route('admin.country.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for update Country data
    @input: Country
    @Output: Update Country data
    -------------------------------------------------------------------------------------------- */
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'country'           => "required",
            'service_tax_fee'   => "sometimes",
            'image'             => 'image|mimes:jpeg,png,jpg,gif|max:3000',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        try{
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = Str::random(10).'.'.$extension;
                Storage::disk('public')->putFileAs('country_flag', $file,$filename);
            }else{
                $filename = 'default.png';
            }
            Country::where('id',$id)->update([
                'country'           =>  @$request->country,
                'service_tax_fee'   =>  @$request->service_tax_fee,
                'image'             =>  @$filename,
            ]);
            Notify::success('Country updated successfully');
            return redirect()->route('admin.country.index');
        }catch(\Exception $e){
            return back()->with([
                'alert-type'    => 'danger',
                'message'       => $e->getMessage()
            ]);
        }
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for get country
    @input: id
    @Output: Get get country
    -------------------------------------------------------------------------------------------- */
    public function getcountry($id){
        $language = Country::where('id',$id)->first();
        return ["data" => $language,"status"=>"success"];
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for destroy
    @input: id
    @Output: delete Country
    -------------------------------------------------------------------------------------------- */
    public function destroy($id){
        // dd("in");
        $country = Country::where('id',$id)->first();
        $country->delete();
        Notify::success('Country deleted successfully.');
        return response()->json([
            'status'    => 'success',
            'title'     => 'Success!!',
            'message'   => 'Country removed successfully.'
        ]);
    }

    /* -----------------------------------------------------------------------------------------
    @Description: Function for Country Status
    @input: Country
    @Output: Status Country Change 
    -------------------------------------------------------------------------------------------- */
    public function change_status(Request $request){
        try{
            $country = Country::where('id',$request->id)->first();
            // dd($country);
            if($country === null){
                return redirect()->back()->with([
                    'status'    => 'warning',
                    'title'     => 'Warning!!',
                    'message'   => 'User not found !!'
                ]);
            }else{
                if($country->status == "active"){
                    Country::where('id',$request->id)->update([
                        'status' => "inactive",
                    ]);
                }
                if($country->status == "inactive"){
                    Country::where('id',$request->id)->update([
                        'status'=> "active",
                    ]);
                }
            }

            Notify::success('Country status updated successfully !!');
            return response()->json([
                'status'    => 'success',
                'title'     => 'Success!!',
                'message'   => 'Country status updated successfully.'
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