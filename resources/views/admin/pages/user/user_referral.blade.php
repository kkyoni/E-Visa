@extends('admin.layouts.app')

@section('mainContent')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12 color_title">
        <h2><i class="fa fa-paper-plane"></i> Referral Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Referral Management Table</strong>
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
        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal_css">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">User Details</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table ">
                            <tbody>
                            <tr>
                                <td><strong>Name  </strong></td>
                                <td class="name"></td>
                                <td>|</td>
                                <td><strong>Email address </strong></td>
                                <td class="email"></td>
                            </tr>
                            <tr>
                                <td><strong>User Type </strong></td>
                                <td class="user_type"></td>
                                <td>|</td>
                                <td><strong>Status </strong></td>
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
        $(document).on("click","a.deleteuser",function(e){
            var row = $(this);
            var id = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#e69a2a",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {
                    $.ajax({
                        url:"{{route('admin.delete',[''])}}"+"/"+id,
                        type: 'post',
                        data: {"_token": "{{ csrf_token() }}"
                        },
                        success:function(msg){
                            if(msg.status == 'success'){
                                location.reload();
                            }else{
                                swal("Warning!", msg.message, "warning");
                                //swal("Deleted!",  msg.message, "success");

                            }
                        },
                        error:function(){
                            swal("Error!", 'Error in delete Record', "error");
                        }
                    });
                    //swal("Deleted!", "Operator has been deleted.", "success");

                } else {
                    swal("Cancelled", "Your user is safe :)", "error");
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
                        url:"{{ route('admin.change_status','replaceid') }}",
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

        $(document).on("click","a.user_info",function(e){

            var id = $(this).attr('data-id');
            $.ajax({
                url:"{{route('admin.get_user_info_data',[''])}}"+"/"+id,
                type: 'post',
                data: {"_token": "{{ csrf_token() }}"
                },
                success:function(data) {
                    $('.name').html(data.name);
                    $('.email').html(data.email);
                    $('.user_type').html(data.user_type);
                    $('.status').html(data.status);
                    $('#myModal2').modal('show');

                },
                error:function(){
                    swal("Error!", 'Error in Not Get Record', "error");
                }
            });
        });
    </script>
@endsection
