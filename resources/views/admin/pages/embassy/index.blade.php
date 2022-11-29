@extends('admin.layouts.app')

@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12 color_title">
        <h2><i class="fa fa-building"></i> Embassy Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Embassy Management Table</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-content">
					<div class="col-md-12 text-right">

                        @php
                        $checkPermission = \App\Helpers\Helper::checkPermission(['emb-create']);
                        @endphp
                        @if($checkPermission)
                        <a class="btn btn-sm btn-primary  pull-right mb-3 op-btn" href="{{route('admin.embassy.create')}}">
                            <i class="icon-plus fa-fw">
                            </i>
                            Add Embassy
                        </a>
                        @endif

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

 <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">>
    <div class="modal_css">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Embassy Detail</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Country </strong></td>
                            <td class="country"></td>
                            <td>|</td>
                            <td><strong>Embassy </strong></td>
                            <td class="embassy"></td>
                        </tr>
                        <tr>
                            <td><strong>Address </strong></td>
                            <td class="address"></td>
                            <td>|</td>
                            <td><strong>Status</strong></td>
                            <td class="status"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')

<style type="text/css">
	table.dataTable {
		clear: both;
		margin-top: 6px !important;
		margin-bottom: 6px !important;
		max-width: none !important;
		border-collapse: separate !important;
		width: 100% !important;
	}
	.op-btn{
		margin-right:22px;
	}

    .modal_css{
        max-width: 700px;
        margin: 1.75rem auto;
    }
</style>

@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
{!! $html->scripts() !!}
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
					url:"{{ route('admin.embassy_change_status','replaceid') }}",
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

    $(document).on("click","a.deleteembassy",function(e){
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
                    url:"{{route('admin.embassy.delete',[''])}}"+"/"+id,
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

    $(document).on("click","a.viewEmbassy",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        $.ajax({
            url:"{{route('admin.embassy.ShowEmbassy',[''])}}"+"/"+id,
            type: 'GET',
            data: {id: id},
            success:function(msg){
                $('.country').html(msg.country);
                $('.address').html(msg.address);
                $('.status').html(msg.status);
                $('.embassy').html(msg.embassy);
                $('#myModal4').modal('show');
            },
            error:function(){
                swal("Error!", 'Error in view Record', "error");
            }
        });
    });
    setTimeout(function(){
        $('#dataTableBuilder_length').addClass('pull-left');
        $('#dataTableBuilder_info').addClass('pull-left');
    }, 200);
</script>
@endsection
