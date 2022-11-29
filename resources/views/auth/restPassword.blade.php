@extends('admin.layouts.appAuth')

@section('authContent')

<style type="text/css">
	.ibox-content{
		width: 350px;
		height: 310px;
		top: 150px;
		position: absolute;
	}
</style>
<div class="row">

	<div class="col-md-12">

		<div class="ibox-content">

			<h2 class="font-bold">Forgot password</h2>

			<div class="row">

				<div class="col-lg-12">
					<form class="m-t" role="form" method="POST" action="{{ route('admin.sendLinkToUser') }}">
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
						<label class="pull-left">Email address</label>
						<div class="form-group">
							<input type="email"  name="email" class="form-control" placeholder="Email address" required="">
						</div>



						<button type="submit" class="btn btn-primary block full-width m-b">Send new password</button>

					</form>
					<a href="{{route('admin.login')}}">{{ __('Back to login') }}</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('authStyles')

@endsection

@section('authScripts')


@endsection






