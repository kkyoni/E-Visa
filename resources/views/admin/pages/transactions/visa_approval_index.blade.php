@extends('admin.layouts.app')
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12 color_title">
        <h2><i class="fa fa-check"></i> Visa Approval Report</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Visa Approval Report Table</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-content">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            {!! $html->table(['class' => 'table table-striped dataTable'], true) !!}
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

        <h5 class="modal-title pull-left" id="exampleModalLabel1">Visa Approval Detail</h5>
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
    table.dataTable{width:100% !important;}
    input, textarea, select, button, meter, progress {height: 2.05rem; width: 75px; display: inline-block; background-color: #FFFFFF; background-image: none; border: 1px solid #e5e6e7; border-radius: 1px; color: inherit; padding: 6px 12px; transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;}
</style>
<link rel="stylesheet" type="text/css"  href="{{ asset('new/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" type="text/css"  href="{{ asset('new/buttons.dataTables.min.css') }}" />
@endsection
@section('scripts')
<script>
$(document).on("click","a.viewapprovaltransactions",function(e){
        var row = $(this);
        var id = $(this).attr('data-id');
        $.ajax({
          url:"{{ route('admin.transaction.approvalshow') }}",
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
<script src="{{ asset('new/jszip.min.js') }}"></script>
<script src="{{ asset('new/pdfmake.min.js') }}"></script>
<script src="{{ asset('new/vfs_fonts.js') }}"></script>
<script src="{{ asset('new/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('new/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('new/buttons.flash.min.js') }}"></script>
<script src="{{ asset('new/buttons.html5.min.js') }}"></script>
<script src="{{ asset('new/buttons.print.min.js') }}"></script>
{!! $html->scripts() !!}
@endsection