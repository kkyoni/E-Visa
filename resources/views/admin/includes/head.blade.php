<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>{{Settings::get('project_title')}}</title>
	<link rel="icon" href="{{ url(\Settings::get('favicon_logo')) }}" type="{{ url(\Settings::get('favicon_logo')) }}" sizes="16x16">
	<link href="{{ asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/animate.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/style.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<link href="{{ asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
	
	<link href="{{ asset('assets/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css.map">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
	@yield('styles')
	<style type="text/css">
		.btn-primary:hover, .btn-primary:focus, .btn-primary.focus{background-color: #f15e2d; border-color: #f15e2d;}
		.btn-danger{background-color: #fc5454; border-color: #fc5454;}
		.btn-danger:hover, .btn-danger:focus, .btn-danger.focus{background-color: #fc3b3b; border: 1px solid #fc3b3b;}
		.btn-dark{background-color: #02c58d; border-color: #02c58d;}
		.btn-dark:hover{background-color: #02ac7b; border: 1px solid #02ac7b;}
		.table-striped tbody tr:nth-of-type(odd){background-color: #f0f4f7;}
		table.dataTable{color:#212529; font-family: "Poppins", sans-serif;}
		.table{color: #212529; font-family: "Poppins", sans-serif;}
		body.mini-navbar.fixed-sidebar .profile-element, .block{color: #212529;}
		.google_translate_element{margin-top:9px;}
        .goog-te-gadget-simple{background-color: #fff !important; border-left: 1px solid #DDD !important; border-top: 1px solid #DDD !important; border-bottom: 1px solid #DDD !important; border-right: 1px solid #DDD !important; font-size: 10pt !important; display: inline-block !important; padding-top: 0px !important; padding-bottom: 0px !important; cursor: pointer !important; zoom: 1 !important;}
        .goog-te-gadget img{display: none;}
        .goog-te-gadget-simple .goog-te-menu-value span{color: #676a6c !important; font-size: 13px; border-left:0px !important; font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;}
        .goog-te-banner-frame{display: none !important;}
        body{top: 0px !important;}
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{color: #FFF; background-color: #f15e2d; border-color: #f15e2d #f15e2d #f15e2d;}
        .color_title{color:#212529}
    </style>
</head>
