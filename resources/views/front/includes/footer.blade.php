<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="foo-logo"><img src="{{ url(\Settings::get('site_logo')) }}" alt=""></div>
                    <div class="foo-address">
                        {{Settings::get('address')}}
                        <!-- 1600, Pennsylvania Ave<br> NW, Washington, USA -->
                        <a href="#" class="whatsapp">+{{Settings::get('whatsapp_number')}}</a>
                    </div>
                    <div class="follow-us">
                        <div class="fu-title">Follow us</div>
                        <ul class="follow-us-ul">
                            <li><a href="{{Settings::get('fb_link')}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="{{Settings::get('twitter_link')}}" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="{{Settings::get('instagram_link')}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="{{Settings::get('linkedin_link')}}" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="foo-title">Support</div>
                    <ul class="foo-link">
                        <li><a href="{{ route('front.termscondition') }}">Terms and condition</a></li>
                        <li><a href="{{ route('front.privacypolicy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('front.faq') }}">FAQ</a></li>
                        <li><a href="{{ route('front.paymentterms') }}">Payment Terms</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="foo-title">Other Links</div>
                    <ul class="foo-link">
                        <li><a href="{{ route('front.about') }}">About us</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('front.populardestinations') }}">Popular Destinations</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="foo-title">Payment Options</div>
                    <div class="we-accpet"><img src="{{asset('images/we-accpet.png')}}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
    <div class="foo-botom">
        <div class="container">
            © {{ date('Y') }} {{Settings::get('footer_text')}}
        </div>
    </div>
</footer>


<!-- go premium modal start -->
<div class="login-modal modal fade fade-scale @if(session()->has('isLogin')) open @else closed @endif" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="login-modal-content">
                    <div class="lm-logo"><img src="{{asset('images/foo-logo.png') }}" alt=""></div>
                    <div class="sec-title">Login <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                    <div class="lm-welcome">Welcome back, Login to your account</div>
                    <form action="{{ route('front.login') }}" method="POST">
                        @csrf
                        <div class="lm-form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Email Address">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="remebar-forgot">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline">Remember my preference</label>
                                </div>
                                <a href="#forgotPassword-modal" data-toggle="modal" data-dismiss="modal" class="forgotPassword-btn">Forgot password?</a>
                            </div>
                            <div class="lm-btn"><button type="submit" class="arrow-btn bon"><span class="ab-text">Login</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></button></div>
                            <div class="lm-botm">
                                <span class="login-with">Or Login With</span>
                                <div class="social">
                                    <a href="{{ url('/login/facebook') }}" class="fb-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                    <a href="{{ url('/login/google') }}" class="google"><img src="{{asset('images/google.png') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- go premium modal end -->
<div class="login-modal modal fade fade-scale" id="forgotPassword-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="login-modal-content">
                    <div class="lm-logo"><img src="{{asset('images/foo-logo.png') }}" alt=""></div>
                    <div class="sec-title">Forgot Password <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                    <div class="lm-welcome forget-text">We Just need your registered mobile number/Email address to send you password reset instructions</div>
                    {!! Form::open([ 'route' => 'front.forgotPassword_set','id'=>'forgot_pwd', 'method'=>'POST' ]) !!}
                    <div class="lm-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Mobile Number/Email Address" name="email">
                        </div>
                        <div class="lm-btn">
                            <button type="submit" class="arrow-btn full-width m-b bon">
                                <span class="ab-text">Reset password</span>
                                <img src="{{asset('images/right-arrow-white.png') }}" alt="">
                            </button>
                        </div>
                        <div class="back-login"><a href="#login-modal" data-toggle="modal" data-dismiss="modal"><img src="{{asset('images/left-arrow-blue.png') }}" alt=""> Back to Login</a></div>
                    </div>
                    {!!  Form::close()  !!}
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
.help-block{color: red}
.open{
   display:block;
}
.closed{
   display:none;
}
</style>
@endsection

@section('scripts')
@if (session()->has('isLogin'))
    <script>
       $('#login-modal').modal('show');
    </script>
@endif
@endsection
