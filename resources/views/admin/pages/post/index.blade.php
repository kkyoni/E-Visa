@extends('admin.layouts.app')

@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12 color_title">
        <h2><i class="fa fa-question-circle"></i> Post Payment Question Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Post Payment Question Management Table</strong>
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
                        <div class="col-md-6">
                            <label class="font-normal"></label>
                            <div class="input-daterange input-group" id="datepicker">
                                {!! Form::select('country_id',$country_list,@$country_id,[
                                'class'         => 'form-control country_id',
                                'id'            => 'country_id',
                                'placeholder'   => 'Select Country','required'
                                ]) !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {!! Form::select('visa_type_id',
                                $visa_types,
                                @$visatypeid,
                                ['class' => 'form-control visa_type_id','id'  => 'visa_type_id',
                                'placeholder'   => 'Select Visa '
                                ]) !!}
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-12 text-right">
                        @php 
                        $checkPermission = \App\Helpers\Helper::checkPermission(['question-create']);
                        @endphp
                        @if($checkPermission)
                        <a class="btn btn-sm btn-primary  pull-right mb-3 op-btn" href="{{route('admin.post.create')}}">
                            <i class="icon-plus fa-fw">
                            </i>
                            Add Post Payment
                        </a>
                        @endif
                        {!! Form::select('visa_type_id',$visa_types,@$visatypeid,['class' => 'col-md-2 mr-3 pull-right form-control visa_type_id','id'  => 'visa_type_id','placeholder'   => 'Select Visa ']) !!}
                        {!! Form::select('country_id',$country_list,@$country_id,['class'         => 'col-md-2 mr-3 pull-right form-control country_id','id'            => 'country_id','placeholder'   => 'Select Country','required']) !!}
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

<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title pull-left" id="exampleModalLabel1">Post Payment Question Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body testdata">
        <h3>Modal Body</h3>
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
    $(document).on("click","a.viewpre",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        $.ajax({
          url:"{{ route('admin.post.show') }}",
          type: 'get',
          data: {id: id},
          success:function(msg){
            $('.testdata').html(msg);
            $('#basicModal').modal('show');
        },
        error:function(){
            swal("Error!", 'Error in Record Not Show', "error");
        }
    });
    });
</script>
<script type="text/javascript">
	$(document).on("click",".changeStatusRecord",function(e){
		var row = $(this);
		var id = $(this).attr('data-id');
		swal({
			title: "Are you sure?",
			text: "You want's to update this record status ",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#e69a2a",
			confirmButtonText: "Yes, updated it!",
			cancelButtonText: "No, cancel plx!",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm){
			if (isConfirm) {
				$.ajax({
					url:"{{ route('admin.post.change_status','replaceid') }}",
					type: 'post',
					data: {"_method": 'post',
                  'id':id,
                  "_token": "{{ csrf_token() }}"
              },
              success:function(msg){
               if(msg.status_code == 200){
                  swal("Warning!", msg.message, "warning");
              }else{

                  location.reload();
              }
          },
          error:function(){
           swal("Error!", 'Error in updated Record', "error");
       }
   });
				//swal("Updated!", "Status has been updated.", "success");

			} else {
				swal("Cancelled", "Your Status is safe :)", "error");
			}
		});
		return false;
	})

    $(document).on("click","a.deletepre",function(e){
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
                    url:"{{route('admin.post.delete',[''])}}"+"/"+id,
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
                            // row.parent().parent().remove();
                            location.reload();
                        }
                    },
                    error:function(){
                        swal("Error!", 'Error in delete Record', "error");
                    }
                });
            } else {
                swal("Cancelled", " Visa Type is safe :)", "error");
            }
        });
        return false;
    })

    $('#country_id').change(function () {
        var  country_id=$(this).val();
        if(country_id){
            window.location.replace("{{route('admin.post.country_index',[''])}}"+"/"+country_id);
        }else{
            window.location.replace("{{route('admin.post.index')}}");
        }
    })
    $('#visa_type_id').change(function () {
        var  visa_type_id=$(this).val();
        if(visa_type_id){
            window.location.replace("{{route('admin.post.visatype_index',[''])}}"+"/"+visa_type_id);
        }else{
            window.location.replace("{{route('admin.post.index')}}");
        }
    })
</script>
@endsection