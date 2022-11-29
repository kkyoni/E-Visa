<head>
	<!--meta info-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/favicon.ico">
    <title>{{Settings::get('project_title')}} - @yield('title')</title>
    <link rel="icon" href="{{ url(\Settings::get('favicon_logo')) }}" type="{{ url(\Settings::get('favicon_logo')) }}" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
    @yield('styles')
</head>
