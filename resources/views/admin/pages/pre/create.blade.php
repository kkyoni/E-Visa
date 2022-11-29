
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
	<!-- <div class="col-lg-10">
		<h2>Add Pre Payment Question</h2>
	</div>
	<div class="col-lg-2">

	</div> -->
	<div class="col-lg-12 color_title">
		<h2> Pre Payment Question Management</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ route('admin.dashboard') }}">Home</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{route('admin.pre.index')}}">Pre Payment Question Table</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>Add Pre Payment Question Form</strong>
			</li>
		</ol>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h5></small></h5>

				</div>
				<div class="ibox-content">
					{!! 
					Form::open([
					'route'	=> ['admin.pre.store'],
					'id'	=> 'userCreateForm',
					'files' => 'true' 
					])
					!!}
					@include('admin.pages.pre.form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection


