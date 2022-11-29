@extends('front.layouts.app')
@section('title', 'No Visa')
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
                    <div class="lm-logo"><img src="images/foo-logo.png" alt=""></div>
                    <div class="sec-title">Check your order <br> status by <img src="images/plane-right.png" alt=""></div>
                    <div class="appli-login-radio">
                        <div class="custom-control custom-radio ">
                            <input type="radio" class="custom-control-input" name="customRadio" checked value="applicant" id="radio-1">
                            <label class="custom-control-label" for="radio-1">Applicant Number</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="customRadio" value="login-detail" id="radio-2">
                            <label class="custom-control-label" for="radio-2">Login Details</label>
                        </div>
                    </div>
                    <div class="lm-form">
                        {!!
                            Form::open([
                            'route'	=> ['front.check_orderstatus'],
                            'id'	=> 'applynowform',
                            'files' => 'true'
                            ])
                        !!}
                        <div class="form-group">
                            <input type="text" class="form-control appli-mob applicant" placeholder="Applicant Number" name="application_no">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control appli-mob login-detail" placeholder="Mobile number/Email address" name="mobile_email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control appli-mob login-detail" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control appli-mob applicant" placeholder="Last Name" name="last_name">
                        </div>
                        <div class="lm-btn">
{{--                            <a href="{{ route('front.track_order')  }}" class="arrow-btn"><span class="ab-text">Check Status</span>--}}
{{--                                <img src="images/right-arrow-white.png" alt="">--}}
{{--                            </a>--}}
                            <button type="submit" class="arrow-btn bon">
                                <span class="ab-text">Check Status</span>
                                <img src="images/right-arrow-white.png" alt="">
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
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
