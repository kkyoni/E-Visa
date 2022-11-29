 <!-- jQuery -->
<script src="{{ asset('assets/front/vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/inspinia.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
<script type="text/javascript">
	$("#example1").on('change', function() {
		if ($(this).is(':checked')) {
			$Url = "down"
			document.location.href=$Url;
		} else {
			$Url = "up"
			document.location.href=$Url;
			
		}
	});
</script>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 300);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("wrapper").style.display = "block";
}
</script>
{!! Notify::render() !!}
@yield('scripts')
