@extends('admin.layouts.app')

@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12 color_title">
		<h2><i class="fa fa-universal-access"></i> Order Status</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>Order Status Table</strong>
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
							<!-- @if(auth()->user()->user_type == 'Manager')
							@if(auth()->guard('web')->user()->hasPermissionTo('add-user'))
							<a class="btn btn-success  pull-right mb-3 op-btn" href="{{route('admin.create')}}">
								<i class="icon-plus fa-fw">
								</i>
								Add User
							</a>
							@endif
							@else
							<a class="btn btn-success  pull-right mb-3 op-btn" href="{{route('admin.create')}}">
								<i class="icon-plus fa-fw">
								</i>
								Add User
							</a>
							@endif -->
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title pull-left" id="exampleModalLabel1">Order Status Detail</h5>
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
</style>

@endsection
@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
{!! $html->scripts() !!}
<script type="text/javascript">
	$(document).on("change","#changeStatus",function(e){
		var row = $(this);
		var id = $(this).attr('data-id');
		var value = $(this).val();

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
					url:"{{ route('admin.order.change_status','replaceid') }}",
					type: 'post',
					data: {"_method": 'post',
					'id':id,
					'status':value,
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
			} else {
				location.reload();
			}
		});
		return false;
	})

	$(document).on("click","a.vieworder",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        $.ajax({
          url:"{{ route('admin.order.show') }}",
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
@endsection
