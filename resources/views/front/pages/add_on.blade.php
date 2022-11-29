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
        <!-- Recommended Add start -->
        <div class="recommended-add">
            <div class="container">
                <div class="sec-title">Recommended Add <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                <div class="ra-sub-title">You can get mailed the completed processed visa on your address by paying the shipping fee.</div>
                <div class="recommended-add-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address line 1</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Address line 2</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Postal Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Country</label>
                                {!! Form::select('country',$countries,null,[
                                'class'         => 'form-control custom-select select2',
                                'id'            => 'country',
                                'placeholder'   => 'Please Select Country'
                                ]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="summary-payment">
                        <div class="sp-title">
                            <div class="sec-title">Order summary</div>
                            <div class="shipping"><img src="{{asset('images/plane-red.png') }}" alt=""> Shipping Fee = AED 110</div>
                        </div>
                        <div class="sp-title">
                            <div class="sec-title">Payment via</div>
                            <div class="shipping">Visa with card number 0011</div>
                        </div>
                    </div>
                    <div class="recommended-add-btn">
                        <a href="#" class="arrow-btn"><span class="ab-text">Pay and get visa shipped</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recommended Add start -->

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
        });
    </script>
@endsection
