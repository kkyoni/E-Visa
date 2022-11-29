@extends('front.layouts.appAuth')
@section('title', 'Forgot Password Page')
@section('authContent')
<div class="page-content">                  
    <!-- Sign Up SECTION -->
    <div class="main-content loging_wrap">
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">   
                        <div id="exTab1" class="login_screen">  
                            @if(Session::has('message'))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-{!! Session::get('alert-type') !!}">
                                            <strong>{!! Session::get('message') !!}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <ul  class="nav nav-pills">
                                <li class="active"><a  href="#1a" data-toggle="tab">Forgot Password</a></li>
                            </ul>
                            <div class="tab-content clearfix">
                            <form action="{{route('front.sendLinkToUser')}}" method="post">
                            @csrf
                                <div class="tab-pane active" id="1a">
                                    <div class="form-group">
                                        <div class="email">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                        </div>
                                        @error('email')
                                          <span class="invalid-feedback" role="alert" style="color: red">
                                            <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                    </div>
                                    <div class="login_btn">
                                    <button type="submit" title="Log in" class="button">
                                        <span style="width:161px; text-align:center; vertical-align:middle;padding: 0;">Forgot Password</span>
                                    </button>
                                    </div>
                                    <div class="on-account"> 
                                       Back to login? 
                                        <a href="{{route('front.showLoginForm')}}">Login</a>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sign Up SECTION -->
</div>
@endsection

@section('authStyles')

@endsection

@section('authScripts')


@endsection
