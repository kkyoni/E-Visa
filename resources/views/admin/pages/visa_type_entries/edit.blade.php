<!-- admin user update -->
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
		<h2>Edit Visa Type Entry</h2>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
				</div>
				<div class="ibox-content">
					{!!Form::model($visatypeentry,array('method'=>'post','files'=>true,'route'=>array('admin.visa_type_entry.update',$visatypeentry->id)))!!}
					@include('admin.pages.visa_type_entries.form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection


