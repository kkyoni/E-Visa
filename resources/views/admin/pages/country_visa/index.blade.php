@extends('admin.layouts.app')

@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12 color_title">
        <h2><i class="fa fa-map"></i> Country Wise Visa Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Country Wise Visa Management Table</strong>
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
                        $checkPermission = \App\Helpers\Helper::checkPermission(['countrywisevisa-create']);
                        @endphp
                        @if($checkPermission)
                        <a class="btn btn-sm btn-primary  pull-right mb-3 op-btn" href="{{route('admin.country_visa.create')}}">
                            <i class="icon-plus fa-fw">
                            </i>
                            Add Country Wise Visa
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
</div>

<div class="modal inmodal" id="myModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal_css">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Country wise Visa Details</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Destination Country  </strong></td>
                            <td class="country"></td>
                            <td>|</td>
                            <td><strong>Visa Type  </strong></td>
                            <td class="visatype"></td>
                        </tr>
                        <tr>
                            <td><strong>Visa Validity</strong></td>
                            <td class="visa_validity"></td>
                            <td>|</td>
                            <td><strong>Stay Validity </strong></td>
                            <td class="stay_validity"></td>
                        </tr>
                        <tr>
                            <td><strong>Regular Service Cost </strong></td>
                            <td class="regular_service_cost"></td>
                            <td>|</td>
                            <td><strong>Express Service Cost </strong></td>
                            <td class="express_service_cost"></td>
                        </tr>
                        <tr>
                            <td><strong>Goverment Fee : Express </strong></td>
                            <td class="express_gov_fee"></td>
                            <td>|</td>
                            <td><strong>Goverment Fee : Regular </strong></td>
                            <td class="regular_gov_fee"></td>
                        </tr>
                        <tr>
                            <td><strong>Service Type : Regular</strong></td>
                            <td class="regular_service_type"></td>
                            <td>|</td>
                            <td><strong>Service Type : Express </strong></td>
                            <td class="express_service_type"></td>
                        </tr>

                        <tr>
                            <td><strong>Status</strong></td>
                            <td class="status"></td>
                            <td>|</td>
                            <td><strong>From Country </strong></td>
                            <td class="country_from"></td>
                        </tr>
                        <tr>
                            <td><strong>Information</strong></td>
                            <td class="information"></td>
                            <td>|</td>
                            <td><strong>Required Documents </strong></td>
                            <td class="required_docs"></td>
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



<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title pull-left" id="exampleModalLabel1">Country Wise Visa Detail</h5>
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

    $(document).on("click","a.deletevisacountry",function(e){
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
                    url:"{{route('admin.country_visa.delete',[''])}}"+"/"+id,
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

    $(document).on("click","a.viewDetail",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        $.ajax({
            url:"{{route('admin.country_visa.show',[''])}}"+"/"+id,
            type: 'get',
            data: {id: id},
            success:function(data){
                $('.testdata').html(data);
                $('#basicModal').modal('show');
            },
            error:function(){
                swal("Error!", 'Error in delete Record', "error");
            }
        });
    });

     $(document).on("click","a.start",function(e){
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
                    url:"{{ route('admin.country_visa.start','replaceid') }}",
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
                    url:"{{ route('admin.country_visa.change_status','replaceid') }}",
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
    $(document).on("click","a.addclone",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure want to Create Clone?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e69a2a",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:"{{route('admin.country_visa.createclone',[''])}}"+"/"+id,
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id:id
                    },
                    success:function(msg){
                        if(msg.status_code == 200){
                            swal("Clone Created Successfully.",  msg.message, "success");
                            location.reload();
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

    setTimeout(function(){
        $('#dataTableBuilder_length').addClass('pull-left');
        $('#dataTableBuilder_info').addClass('pull-left');
    }, 200);
</script>
@endsection
