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
            <h2>Edit Pre Payment</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                    </div>
                    <div class="ibox-content">


                        {!!Form::model($prepostpayment,array('method'=>'post','files'=>true,'route'=>array('admin.pre.update',$prepostpayment->id)))!!}

                        @include('admin.pages.pre.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


