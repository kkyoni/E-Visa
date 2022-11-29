@extends('admin.layouts.app')

@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12 color_title">
        <h2><i class="fa fa-money"></i> Price Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Price Management Table</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-content">
                    <!-- <div class="form-group" id="data_5">
                        <div class="col-md-12 row">
                            <label class="font-normal"></label>
                            <div class="input-daterange input-group" id="datepicker">
                                <div class="col-md-5">
                                    <label class="col-md-3 pull-left m-t-xs"><strong> Visa Type</strong></label>
                                    <div class="col-md-6 pull-left">
                                        {!! Form::select('visa_type_id',
                                        $visa_types,
                                        @$visatypeid,
                                        ['class' => 'form-control visa_type_id','id'  => 'visa_type_id',
                                        'placeholder'   => 'Select Visa '
                                        ]) !!}
                                    </div>

                                </div>

                                &nbsp;&nbsp;&nbsp;&nbsp;

                                <div class="col-md-4">
                                    <label class="col-md-2 pull-left m-t-xs"><strong> Status</strong></label>
                                    @php
                                        $status = array('pickup'=>'Pickup','drop-off'=>'Drop-Off')
                                    @endphp
                                    <div class="col-md-8 pull-left">
                                        {!! Form::select('status',$status,@$checkstatus,[
                                        'class' => 'form-control',
                                        'id'	=> 'status',
                                        'required',
                                        'placeholder'=>'Select Status'
                                        ]) !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-12 text-right">
                        @php
                        $checkPermission = \App\Helpers\Helper::checkPermission(['price-create']);
                        @endphp

                        @if($checkPermission)
                        <a class="btn btn-sm btn-primary  pull-right mb-3 op-btn" href="{{route('admin.prices.create')}}">
                            <i class="icon-plus fa-fw">
                            </i>
                            Add Price
                        </a>
                        @endif
                        @php
                        $status = array('pickup'=>'Pickup','drop-off'=>'Drop-Off')
                        @endphp
                        {!! Form::select('status',$status,@$checkstatus,['class' => 'col-md-2 mr-3 pull-right form-control','id'    => 'status','required','placeholder'=>'Select Status']) !!}
                        {!! Form::select('visa_type_id',$visa_types,@$visatypeid,['class' => 'col-md-2 mr-3 pull-right form-control visa_type_id','id'  => 'visa_type_id','placeholder'   => 'Select Visa ']) !!}
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            {!! $html->table(['class' => 'table table-striped'], true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style type="text/css">
	table.dataTable {clear: both; margin-top: 6px !important; margin-bottom: 6px !important; max-width: none !important; border-collapse: separate !important; width: 100% !important;}
	.op-btn{margin-right:22px;}
</style>
@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
{!! $html->scripts() !!}
<script type="text/javascript">
    $(document).on("click","a.deleteprice",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this record",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e69a2a",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:"{{route('admin.prices.delete',[''])}}"+"/"+id,
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id:id
                    },
                    success:function(msg){
                        if(msg.status_code == 200){
                            swal("Warning!", msg.message, "warning");
                        }else{
                            swal("Deleted!",  msg.message, "success");
                            location.reload();
                        }
                    },
                    error:function(){
                        swal("Error!", 'Error in delete Record', "error");
                    }
                });
            } else {
                swal("Cancelled", " Price is safe :)", "error");
            }
        });
        return false;
    })
    setTimeout(function(){
        $('#dataTableBuilder_length').addClass('pull-left');
        $('#dataTableBuilder_info').addClass('pull-left');
    }, 200);


    $('#status').change(function () {
        var  status=$(this).val();
        if(status){
            window.location.replace("{{route('admin.prices.status_index',[''])}}"+"/"+status);
        }else{
            window.location.replace("{{route('admin.prices.index')}}");
        }
    })
    $('#visa_type_id').change(function () {
        var  visa_type_id=$(this).val();
        if(visa_type_id){
            window.location.replace("{{route('admin.prices.visatype_index',[''])}}"+"/"+visa_type_id);
        }else{
            window.location.replace("{{route('admin.prices.index')}}");
        }
    })
</script>
@endsection
