<!-- admin user update -->
@extends('admin.layouts.app')

@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>View Role</h2>
	</div>
	<div class="col-lg-2">

	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-content">
					<div class="container">
						<h2>Operator role permission table</h2>
						<table class="table ">
							<thead>
								<tr>
									<th>#</th>
									<th>Country</th>
									<th>Embassy Country</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
									@foreach($embassy as $key=>$embassy_list)
								<tr>
									<td>{{++$key}}</td>
									<td>{{$embassy_list->country_list->country->country}}</td>
									<td>{{$embassy_list->embassy_country->country}}</td>
									<td>{{$embassy_list->status}}</td>
								</tr>
									@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@section('scripts')
<script>
	$(document).ready(function () {

		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});
	});
</script>
@endsection
@endsection