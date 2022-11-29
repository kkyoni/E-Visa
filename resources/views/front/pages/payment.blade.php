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
    <div class="mid-start">
        <section class="payment">
            <div class="container">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="sec-title sec-title-white d-none d-md-block"><span class="color-red">Payment </span> Information <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>

                        {!!
                            Form::open([
                            'route'	=> ['front.submit_payment'],
                            'id'	=> 'submit_payment',
                            'files' => 'true'
                            ])
                        !!}
                        <div class="payment-form">
                            <div class="form-group">
                                <label>Card Type</label>
                                <input type="text" class="form-control" name="card_type">
                            </div>
                            <div class="form-group">
                                <label>Card No.</label>
                                <input type="text" name="card_number" class="form-control credit-card" onkeypress="return isNumberKey(event)" maxlength="19">
                            </div>
                            <div class="form-group">
                                <label>Name On Card</label>
                                <input type="text" class="form-control card_name" maxlength="111" name="card_name">
                            </div>
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <div class="expriry-date">
                                    <select class="form-control" name="month">
                                        <option value="">Select Month</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    <select class="form-control" name="year">
                                        <option value="">Select Year</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="text" class="form-control cvv" maxlength="3" name="cvv">
                            </div>
                            <div class="payment-form-btn">
{{--                                <a class="arrow-btn" href="#payment-modal" data-toggle="modal"><span class="ab-text">Pay</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></a>--}}
                                <input type="hidden" class="form-control application_id" value="{{ @$application_id  }}" name="application_id">
                                @if(!@$application_no)
                                <button class="arrow-btn addapplicant" style="border: none;"><span class="ab-text">Pay</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></button>
                                @else
                                    <input type="hidden" value="{{@$application_no}}" id="application_no">
                                @endif

                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6">
                        <div class="sec-title d-sm-block d-md-none"><span class="color-red">Payment </span> Information <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                        <div class="payment-img-top"><img src="{{asset('images/payment-info.png') }}" alt=""></div>
                        <div class="payment-card">
                            Reference site about Lorem Ipsum.
                            <img src="{{asset('images/payment-card.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- payment modal start -->
    <div class="payment-modal modal fade fade-scale" id="payment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="approved-modal">
                        <div class="am-img"><img src="{{asset('images/approved.png') }}" alt=""></div>
                        <div class="am-title">Payment Successful</div>
                        <div class="am-ticket">Ticket Number : {{ @$application_no  }}</div>
                        <div class="am-text">Cheesy feet camembert de normandie danish fontina. Caerphilly pecorino when the cheese comes out everybody's happy pecorino pepper jack pepper jack airedale swiss.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- payment modal end -->
@endsection
@section('styles')
    <style>
        .hidden{ display: none !important; }
        .mid-start{padding: 0;}
    </style>
@endsection
@section('scripts')
    <script src="https://paypage-uat.ngenius-payments.com/hosted-sessions/sdk.js"></script>
    <script>
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        $(document).ready(function () {
            $('#cvv, .cvv').on('keyup onmouseout keydown keypress blur change', function (e) {
                var regex = new RegExp("^[0-9 ._\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    return false;
                }
            });

            $('.card_name').on('keyup onmouseout keydown keypress blur change', function (event) {
                var regex = new RegExp("^[a-zA-Z ._\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
            $('.credit-card').on('keypress change blur', function () {
                $(this).val(function (index, value) {

                    return value.replace(/[^a-z0-9]+/gi, '').replace(/(.{4})/g, '$1 ');
                });
            });

            $('.credit-card').on('copy cut paste', function () {
                setTimeout(function () {
                    $('.credit-card').trigger("change");
                });
            });


            $(window).on('load', function () {
                var val = $('#application_no').val();
                if(val){
                    $('.payment-modal').modal('show');
                }
            });
        });
    </script>
@endsection
