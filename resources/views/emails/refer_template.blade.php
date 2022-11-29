<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{{$subject}}</title>
</head>
<body>
	<table style="border-collapse:collapse;border-spacing:0!important;margin:0 auto; max-width:600px" cellspacing="0" cellpadding="0" border="0">
                    <tbody>
                        <tr>
                            <td valign="top">
                                <table style="border-collapse:collapse;border-spacing:0!important;" cellspacing="0" cellpadding="0" width="100%" border="0" >
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table width="100%">
                                                    <tr>
                                                        <td align="center"><img src="{{asset('images/blog-1.jpg') }}" alt="" style="width:100%; max-width:100%;"></td>
                                                    </tr>
                                                </table>
                                                <table width="100%" style="background-color:#f1f1f1; margin-top: -7px;">
                                                    <tr>
                                                        @if(!empty(Auth::user()->avatar))
                                                        <td align="center"><img src="{!!  \Auth::user()->avatar !== '' ? asset("storage/avatar/".\Auth::user()->avatar) : asset('storage/avatar/default.png') !!}" alt="user-img" style="border-radius: 50%; width: 100px; height: 100px; margin:15px 0"></td>
                                                        @else
                                                        <td align="center"><img src="{!! asset('storage/avatar/default.png') !!}" alt="user-img" style="border-radius: 50%; width: 100px; height: 100px; margin:15px 0"></td>
                                                        @endif
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="color: #0f4373; font-family: Avenir,Helvetica,Arial,sans-serif; font-size: 24px; line-height: normal; font-weight: 600; padding-bottom: 10px;">{{\Auth::user()->name}} Urgent E-visa</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="color: #282828; font-family: Avenir,Helvetica,Arial,sans-serif; font-size:16px; line-height: 22px; padding:0 25px 20px; ">{{$body}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><a href="#" style="color: #fff; font-family: Avenir,Helvetica,Arial,sans-serif; font-size: 16px; line-height: normal; padding: 13px 25px; display: inline-block; background-color: #0f4373; font-weight: 600; text-decoration: none; margin:50px 0 30px;">Browse Services On Fiverr</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><img src="{{asset('images/thanks.jpg') }}" alt=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" style="color: #0f4373; font-family: Avenir,Helvetica,Arial,sans-serif; font-size:18px; line-height: normal; padding: 0 0 25px 0;  ">The Urgent E-visa Team</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
</body>
</html>

