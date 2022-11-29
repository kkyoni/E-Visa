@extends('admin.layouts.app')

@section('mainContent')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-12 color_title">
        <h2><i class="fa fa-map-marker"></i> Country Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Country Management Table</strong>
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
                            <a class="btn btn-sm btn-primary  pull-right mb-3 op-btn" href="{{route('admin.country.create')}}">
                                <i class="icon-plus fa-fw">
                                </i>
                                Add Country
                            </a>
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
                    url:"{{ route('admin.country.change_status','replaceid') }}",
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
        $(document).on("click","a.deletecountry",function(e){
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
                        url:"{{route('admin.country.destroy',[''])}}"+"/"+id,
                        type: 'post',
                        data: {"_method": 'DELETE',
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
                    swal("Cancelled", "Your country is safe :)", "error");
                }
            });
            return false;
        })
    </script>
    <script type="text/javascript">
        $(document).on('click','#close_language',function(){
            $('.language_data').fadeOut('slow');
        });
    </script>

    <script type="text/javascript">
        $(document).on('click','#create_new_language',function(){
            $('#country').val('');
            $('#language').val('');
            $('#language_id').val('');
            $('.language_data').fadeIn('slow');
            $('.form-group').removeClass('has-error');
            $('.help-block').hide();
        });

        $('#country').on('keyup onmouseout keydown keypress blur change', function (event) {
            var regex = new RegExp("^[a-zA-Z ._\\b\\t]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        $('#service_tax_fee').on('keyup onmouseout keydown keypress blur change', function (event) {
            var regex = new RegExp("^[0-9 ._\\b\\t]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });
    </script>
@endsection

