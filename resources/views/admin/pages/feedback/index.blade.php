@extends('admin.layouts.app')

@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12 color_title">
		<h2><i class="fa fa-comments-o"></i> FeedBack Management</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>FeedBack Table</strong>
			</li>
		</ol>
	</div>
	<!-- <div class="col-lg-10">

		<h2>FeedBack Management</h2>

	</div> -->
</div>

<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-content">
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
@endsection
