@extends('front.layouts.app')
@section('title', 'Sign Up')
@section('mainContent')

    <div class="header-bottom home-banner">
        <div class="banner-content">
            <div class="container">
                <div class="bc-title">Travel <span class="color-red">Visa</span> <br> Requirements</div>
                <div class="bc-small-text">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</div>
            </div>
        </div>
    </div>
    </header>
    <!-- mid part start -->
    <div class="mid-start" style="padding: 60px 0;">
        <!-- track your visa start -->
        <div class="container">
            <div class="track-visa">
                <div class="login-modal-content">
                    <div class="lm-logo"><img src="{{asset('images/foo-logo.png') }}') }}" alt=""></div>
                    <div class="sec-title">Signup <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                    <div class="lm-welcome">Welcome, Create your account</div>

                    {!!
                        Form::open([
                        'route'	=> ['front.user_sign_up'],
                        'id'	=> 'user_sign_up',
                        'files' => 'true'
                        ])
                    !!}
                    <div class="lm-form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email Address" name="email" value="{{ @$email }}">
                            @if($errors->has('email'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('email')  }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            @if($errors->has('password'))
                                <div class="help-block">
                                    <strong>{{ $errors->first('password')  }}</strong>
                                </div>
                            @endif
                        </div>
                        <input type="hidden" class="form-control" placeholder="Email Address" name="application_id" value="{{ @$application_id }}">
                        <div class="lm-btn">
                            <button class="arrow-btn" type="submit"><span class="ab-text">Create Account</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></button>
                        </div>
                        <div class="lm-botm hidden">
                            <span class="login-with">Or Sign Up With</span>
                            <div class="social">
                                <a href="#" class="fb-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#" class="google"><img src="{{asset('images/google.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="sec-title">Benefits To  <br> <span class="color-red">Create Account</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                    <p>Cheesy feet camembert de normandie danish fontina. Caerphilly pecorino when the cheese comes out everybody's happy pecorino pepper jack pepper jack airedale swiss. Chalk and cheese queso mascarpone edam croque monsieur camembert de normandie rubber cheese camembert de normandie. Macaroni cheese paneer queso cheese on toast cheesecake stilton.</p>
                    <p>Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. Edam boursin blue castello boursin caerphilly red leicester airedale brie. Roquefort swiss stinking bishop.</p>
                </div>
            </div>
        </div>
        <!-- track your visa start -->

    </div>
@endsection
@section('styles')
    <style>
        .hidden{ display: none !important; }
        .mid-start{padding: 0;}
    </style>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#electronic-tab').on('click', function () {
                $('#service_type').val('regular');
            });
            $('#e-visa-tab, .nav-express').on('click', function () {
                $('#service_type').val('express');
            });

            $('.appli-login-radio input[type="radio"]').click(function(){
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".appli-mob").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
@endsection
