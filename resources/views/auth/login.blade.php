@extends('front.layouts.appAuth')

@section('authContent')

<style type="text/css">
	.ibox-content{
		width: 350px;
		height: 330px;
		top: 150px;
		position: absolute;
	}
</style>

<div class="ibox-content">
	<h2 class="font-bold">User Login</h2>
	<div class="row">
		<div class="col-lg-12">
			<h3>Welcome to {{Settings::get('project_title')}} </h3>
			<form method="POST" action="{{ route('front.login') }}">
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
					<input id="exampleInputEmail_2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email" autofocus>
					@error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
				</div>
				<div class="form-group">
					<input type="password" class="form-control" required="" id="exampleInputEmail_3" placeholder="Enter Password" name="password" autocomplete="current-password">
					@error('password')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror

				</div>
				<button type="submit" class="btn btn-primary block full-width m-b">Login</button>

				<a href="{{ route('front.resetPassword') }}"><small>Forgot password?</small></a>

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






