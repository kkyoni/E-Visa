
@extends('admin.layouts.app')

@section('mainContent')
	@if(Session::has('message'))
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-{{ Session::has('alert-type') }}">
					{!! Session::get('message') !!}
				</div>
			</div>
		</div>
	@endif
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Visa Applicants Details</h2>
		</div>
		<div class="col-lg-2 m-t-md">
             <a href="{{ route('admin.order.index')  }}" class="btn btn-primary">Back</a>
		</div>
	</div>
	<div class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox ">
					<div class="ibox-title">
                        <div class="col-md-12 row" style="">
                            <div class="col-md-3"><strong style="padding-left: 3em;">Current Status</strong></div>
                            <div class="col-md-3"><strong style="padding-left: 4em;">Applicant Name</strong> </div>
                            <div class="col-md-5"><strong style="padding-left: 7em;">Status</strong></div>
                        </div>
					</div>
					<div class="ibox-content">
						<div class="ibox">
							<div class="ibox-content1">
								<div class="row">
                                @if(!empty($visaapplication))
									@foreach($visaapplication->visa_applicants as $views)
                                        <div class="col-md-12 row doc_block" style="">
                                            <div class="col-md-3">
                                                @if($views->status === 'approved' || $views->status === 'completed')
                                                    <span class="text-success">{{ ucfirst($views->status) }}</span>
                                                @elseif($views->status === 'rejected')
                                                    <span class="text-danger">{{ ucfirst($views->status) }}</span>
                                                @elseif($views->status === 'waiting_for_gov')
                                                    <span class="text-primary">{{ ucfirst('waiting for government approval') }}</span>
                                                @else
                                                    <span class="text-primary">{{ ucfirst($views->status) }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                {!!  ucfirst($views->first_name).' '.ucfirst($views->last_name)  !!}
                                            </div>

                                            <div class="col-md-5 row">
                                                @if($views->status === 'approved' || $views->status === 'completed')
                                                    <button class="btn btn-success m-l">{{ ucfirst($views->status) }}</button>
                                                @elseif($views->status === 'rejected')
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reasonmodal{{@$views->id}}" data-whatever="@mdo" style="margin-left: 1.3em;">
                                                        Reason for Reject
                                                    </button>

                                                    <div class="modal fade" id="reasonmodal{{@$views->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">
                                                                            {!!  ucfirst($views->first_name).' '.ucfirst($views->last_name)  !!}
                                                                        </label>
                                                                        <textarea class="form-control" id="message-text" name="reason">{{ @ucfirst($views->reason)  }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-md-8">
                                                    {!! Form::select('applicant_status',$app_status,@$views->status,[
                                                       'class'         => 'form-control applicant_status pull-left',
                                                       'id'            => 'applicant_status',
                                                       'placeholder'   => 'Please Select','required', 'data-id'=>@$views->id
                                                    ]) !!}
                                                    </div>
                                                @endif

                                                @if($views->status !== 'completed')
                                                    @if($views->status !== 'rejected' && ($views->status !== 'approved'))
                                                        <div class="col-md-1">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{@$views->id}}" data-whatever="@mdo">
                                                            Reject
                                                        </button>

                                                        <div class="modal fade" id="exampleModal{{@$views->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    {!!
                                                                        Form::open([
                                                                        'route'	=> ['admin.order.rejectreason'],
                                                                        'id'	=> 'userCreateForm',
                                                                        'files' => 'true'
                                                                        ])
                                                                    !!}
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Reject Visa Application</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="recipient-name" class="col-form-label">
                                                                                <h3> {!!  ucfirst($views->first_name).' '.ucfirst($views->last_name)  !!}</h3>
                                                                            </label>
                                                                            <input type="hidden" name="id" value="{{@$views->id}}">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="col-form-label">Reason for Reject Application:</label>
                                                                            <textarea class="form-control" id="message-text" name="reason"></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="message-text" class="col-form-label">
                                                                                <i> Note: If You Update Visa Application Status as Rejected, You could not again update Status.</i>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                            </div>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
                                        <br><br>
									@endforeach
									<div class="hr-line-dashed"></div>
{{--									<div class="col-sm-6">--}}
{{--										<div class="form-group row">--}}
{{--											<div class="col-sm-8 col-sm-offset-8">--}}
{{--                                                <input type="submit" name="savebtn" value="Approved" class="btn btn-success btn-sm">--}}
{{--                                                <input type="submit" name="savebtn" value="Reject" class="btn btn-danger btn-sm">--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}
                                @endif
								</div>
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
		.selectalllabel{margin-left: 0;}
		#selectall{ top: 3px;left: 12px;float: left;position: relative; }
		.doc_block{margin: 8px 0 16px 0; border-bottom: 1px solid #ccc;padding: 1px 1px 24px 49px; }
		.img-block{margin-bottom: 21px;}
		.docstatus{    top: 6px;position: relative;}
	</style>
@endsection

@section('scripts')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(e) {
			$('.applicant_status').on('change', function () {
                var status = $(this).val();
                var id = $(this).attr('data-id');
                if(status){
                    swal({
                        title: "Are you sure you want to update Status?",
                        text: " ",
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
                                url:"{{ route('admin.order.change_visa_status') }}",
                                type: 'post',
                                data: {"_token": "{{ csrf_token() }}", status:status, id:id
                                },
                                success:function(msg){
                                    if(msg.status == 'success'){
                                        swal("Success!", msg.message, "success");
                                        location.reload();
                                    }else{
                                        swal("Warning!", msg.message, "warning");
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
                }
            });
		});
	</script>

@endsection






