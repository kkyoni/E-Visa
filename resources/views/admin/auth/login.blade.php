@extends('admin.layouts.appAuth')
@section('authContent')
<style type="text/css">
.ibox-content { width: 350px; top: 50%; position: absolute; left: 50%; transform: translate(-50%, -50%); background-size: cover; background-size: cover; box-shadow: 1px 0px 29px -2px #d2d2d2; }
.form-money .bf-botm {justify-content: flex-end; display: flex;}
.form-money .bf-botm .arrow-btn {margin-left: 10%;}
.arrow-btn {background-color: #0f4373; color: #fff; position: relative; padding:10px 20px 10px 15px; z-index: 1; display: inline-block; border:0;}
.arrow-btn img {margin-left: 5px; position: relative; z-index: 1; max-width: 25px}
.arrow-btn .ab-text {position: relative; z-index: 1}
.arrow-btn:after {position: absolute; content: ""; right: 0; top: 0; background-color: #f15e2d; width:8px; height: 100%; transition: all 0.6s;}
.arrow-btn:hover {color: #fff;}
.arrow-btn:hover:after {width: 100%; }
.arrow-btn.yellow-bodr:after {background-color: #fcdc25}
.arrow-btn.yellow-bodr:hover span {color:#0f4373;}
.home-botm-btn .arrow-btn { width: 170px; margin: 0 15px; text-align: center;}
.home-botm-btn .arrow-btn:after {background-color: #fcdc25}
.home-botm-btn .arrow-btn:hover {color:#0f4373;}
.login-modal-content .lm-form .lm-btn .arrow-btn {font-size:17px;}
.login-modal-content .lm-form .lm-btn .arrow-btn img {margin-left: 8px; max-width: 26px;}
.personal-info .personal-info-form .arrow-btn {margin-top: 10px;}
.impo-instruction .arrow-btn {margin-top:30px;}
.multiple-entry .table .arrow-btn {padding: 8px 20px 8px 15px;  font-family: 'Conv_GothamBook'; }
.form-money .banner-form .bf-top.faq-bf-top .arrow-btn {margin: 14px 0 0 20px;}
</style>

<div class="ibox-content">
{{--	<div>--}}
{{--		<img src="{{ url(\Settings::get('site_logo')) }}" class="logo-name">--}}
{{--	</div>--}}
	<h2 class="font-bold">Admin Login</h2>
	<div class="row">
		<div class="col-lg-12">
{{--			 <h3>Admin Login</h3>--}}
{{--            <h3>Welcome to {{Settings::get('project_title')}} </h3>	 ---}}
			<form method="POST" action="{{ url('admin/login') }}">
				@csrf
				@if(Session::has('message'))
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-{!! Session::get('alert-type') !!}">
							{!! Session::get('message') !!}
						</div>
					</div>
				</div>
				@endif
				<div class="form-group">
					<input id="exampleInputEmail_2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" placeholder="Enter Email" autofocus>
					@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="exampleInputEmail_3" placeholder="Enter Password" name="password" autocomplete="current-password">
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror

				</div>
				<div class="bf-botm">
					<button type="submit" class="arrow-btn full-width m-b">
						<span class="ab-text">Login</span>
						<img src="{{ url('images/right-arrow-white.png')}}" alt="">
					</button>
				</div>
				<a href="{{ route('admin.resetPassword') }}"><small>Forgot password?</small></a>

			</form>
			<!-- <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p> -->
		</div>
	</div>
</div>
@endsection
@section('authStyles')
@endsection
@section('authScripts')
@endsection
