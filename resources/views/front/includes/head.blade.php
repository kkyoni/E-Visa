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
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css')}}">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    @yield('styles')
    <style type="text/css">
        .header-bottom{margin-top: -7px;}
        .bon{border: none;}
        /*.goog-te-gadget-simple{background-color: #0e4373 !important; border-left: 0px solid #d5d5d5 !important; border-top: 0px solid #9b9b9b !important; border-bottom: 0px solid #e8e8e8 !important; border-right: 0px solid #d5d5d5 !important; font-size: 10pt !important; display: inline-block !important; padding-top: 0px !important; padding-bottom: 0px !important; cursor: pointer !important; zoom: 1 !important;}*/
        .goog-te-gadget-simple{white-space: nowrap !important; display: inline-block !important; font-weight: 400 !important; text-align: center !important; white-space: nowrap !important; vertical-align: middle !important; -webkit-user-select: none !important; -moz-user-select: none !important; -ms-user-select: none !important; user-select: none !important; border: 1px solid transparent !important; padding: .375rem .75rem !important; font-size: 1rem !important; line-height: 1.5 !important; border-radius: .25rem !important; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out !important; background-color: transparent !important;}
        .goog-te-gadget-simple .goog-te-menu-value span{position: inherit !important; transform: translate3d(0px, -1px, 0px); top: 0px !important; left: 0px !important; will-change: transform !important; margin-top: 0px !important; min-width: initial !important; background-color: #0f4373 !important; padding: 0 !important; z-index: 1000 !important; margin: 0px !important; color: #f9f9f9 !important; text-align: left !important; list-style: none !important; background-clip: padding-box !important; border-radius: .25rem !important; font-size: 14px; border-left:0px !important; cursor: pointer; display: inline-block; white-space: nowrap; vertical-align: middle; user-select: none;}
        .goog-te-gadget img{display: none;}
        /*.goog-te-gadget-simple .goog-te-menu-value span{color: #f9f9f9 !important; font-size: 14px; border-left:0px !important; cursor: pointer; display: inline-block; text-align: center; white-space: nowrap; vertical-align: middle; user-select: none; padding: 0px 0px 2px 1px;}*/
        .goog-te-banner-frame{display: none !important;}
        body{top: 0px !important;}
    </style>
    <script type="text/javascript">{{App\Script::get('header_script')}}</script>
</head>
