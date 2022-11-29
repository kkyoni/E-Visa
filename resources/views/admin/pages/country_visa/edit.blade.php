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
        <div class="col-lg-12 color_title">
        <h2> Country Wise Visa Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.country_visa.index') }}">Country Wise Visa Table</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit Country Wise Visa Form</strong>
            </li>
        </ol>
    </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                    </div>
                    <div class="ibox-content">
                        {!!Form::model($countryvisa,array('method'=>'post','files'=>true,'route'=>array('admin.country_visa.update',$countryvisa->id)))!!}
                        @include('admin.pages.country_visa.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


