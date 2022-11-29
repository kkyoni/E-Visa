@extends('admin.layouts.app')
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-12 color_title">
        <h2><i class="fa fa-code"></i> Script Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Script Management</strong>
            </li>
        </ol>
    </div>
	<!-- <div class="col-lg-10">
		<h2>Script Management</h2>
	</div>
	<div class="col-lg-2"></div> -->
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
                @if($script->id)
				    {!!Form::model($script,array('method'=>'POST','files'=>true,'route'=>array('admin.script.update',$script->id)))!!}
                @else
                    {!!Form::model($script,array('method'=>'POST','files'=>true,'route'=>array('admin.script.update',$script->id)))!!}
                @endif
			@include('admin.pages.script.form')
			<div class="hr-line-dashed"></div>
                <a href="{{route('admin.script.index')}}"><button class="btn btn-danger btn-sm" type="button">Cancel</button></a>
                <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
</div>
@endsection
@section('styles')
@endsection
@section('scripts')
@endsection
