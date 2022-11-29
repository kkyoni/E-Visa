<!DOCTYPE html>
<html lang="en">	
@include('admin.includes.headAuth')
<style type="text/css">
	body{background-size: cover; overflow: hidden;}
</style>
<body id="container">
	<div class="middle-box text-center loginscreen">
		@yield('authContent')	
	</div>
	<!-- Mainly scripts -->
	@include('admin.includes.scriptsAuth')
</body>
</html>



