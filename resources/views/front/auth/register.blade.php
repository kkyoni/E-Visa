@extends('front.layouts.appAuth')

@section('authContent')
@if(Session::has('message'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-{!! Session::get('alert-type') !!}">
            {!! Session::get('message') !!}
        </div>
    </div>
</div>
@endif
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->

<!-- Main Content -->
<div class="page-wrapper pa-0 ma-0 auth-page">
    <div class="container-fluid">
        <!-- Row -->
        <div class="table-struct full-width full-height">
            <div class="table-cell vertical-align-middle auth-form-wrap">
                <div class="auth-form mt-20 ml-auto mr-auto no-float">
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="mb-30">

                                <h3 class="text-center txt-dark mb-10">Sign Up to Sports Game</h3>
                                <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
                            </div>  
                            <div class="form-wrap">
                                <form method="POST" action="{{ route('front.register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label mb-10" for="exampleInputEmail_2">{{ __('Email address') }}</label>
                                        <input id="exampleInputEmail_2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font color="red">{{ $message }}</font></strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="pull-left control-label mb-10">{{ __('Password') }}</label>                                    
                                        <input type="password" class="form-control" required="" id="exampleInputEmail_2" placeholder="Enter Password" name="password" autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong><font color="red">{{ $message }}</font></strong>
                                        </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox checkbox-info pr-10">
                                            <a class="capitalize-font txt-primary block mb-10 pull-left font-12" href="{{ route('front.resetPassword') }}">{{ __('Forgot Password ?') }}</a>
                                            <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="{{ route('front.showLoginForm') }}">{{ __('Already Register ?') }}</a>
                                        <div class="clearfix"></div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-info btn-rounded">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Row -->   
        </div>

    </div>
    <!-- /Main Content -->

</div>

@endsection

@section('authStyles')

@endsection

@section('authScripts')


@endsection



