<!DOCTYPE html>
<html lang="en">
@extends('front.layouts.app')
@section('title', 'Home')
@section('mainContent')
<style type="text/css">
.rate {
    color: #ffc700;
    font-size: 22px;
}
</style>
<body>
 <script type="text/javascript">{{App\Script::get('body_script')}}</script>
<!-- header start -->


<!-- header end -->
<!-- mid part start -->
<div class="mid-start">
    @if(count($feedback) > 0)
    <section class="client-say">
        <div class="container">
            <div class="sec-title">What <span class="color-red">Our Clients</span> Say <img src="{{asset('images/plane-right.png') }}" alt=""></div>
        </div>
        <div class="client-say-row">
            <div class="slider cs-slider">
                @foreach($feedback as $data)
                <div>
                    <div class="client-say-col">
                        <div class="hover-boder"></div>
                        <div class="client-say-box" style="height: 216px;">
                            <div class="csb-top">
                                <div class="client-img">

                                    @if(!empty($data->user_detail) && !empty($data->user_detail->avatar))
                                        <img src="{!! @$data->user_detail->avatar !== '' ? asset("storage/avatar/".@$data->user_detail->avatar) : asset('storage/default.png') !!}" alt="user-img">
                                    @else
                                        <img src="{!! asset('storage/avatar/default.png') !!}" alt="user-img" accept="image/*">
                                    @endif
                                    <!-- <img src="images/client-say.jpg" alt=""> -->
                                </div>
                                <div class="name-country">
                                    <div class="name">
                                        {{$data->user_detail->name}}
                                    </div>
                                    <div class="country">USA</div>
                                    <div class="rating">
                                        <div class="rate">
                                            @for ($i = 0; $i < 5; ++$i)
                                             <i class="fa fa-star{{ $data->rating<=$i?'-o':'' }} rate" aria-hidden="true"></i>
                                             @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bsb-botm">{{ str_limit($data->review, $limit = 110, $end = '...') }}</div>
                        </div>
                    </div>
                </div>
               @endforeach
            </div>
        </div>
    </section>
    @endif
    <!-- popular destination start -->
     @if(count($countryvisa) > 0)
    <section>
        <div class="container">
            <div class="sec-title">Popular<br> <span class="color-red">Destinations</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
            <div class="desti-title-text">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</div>
        </div>
        <div class="destination">
            <div class="slider destination-slider">
                @foreach($countryvisa as $countryvisalist)
                <div>
                    <div class="destination-box">
                        <div class="destination-img">
                            <!-- <img src="images/destination-1.jpg" alt=""> -->
                            @if(!empty($countryvisalist->country->image))
                            <img src="{!! asset('storage/country_flag/'.@$countryvisalist->country->image)!!}">
                            @else
                            <img src="{!! asset('storage/country_flag/default.png') !!}">
                            @endif
                        </div>
                        <div class="destination-arrow"><a href="#"><img src="{{asset('images/right-arrow-white.png') }}" alt=""></a></div>
                        <div class="destination-title">{{$countryvisalist->country->country}}</div>
                        <div class="destination-from">From <span>780 AED</span></div>
                        <div class="destination-day"><img src="{{asset('images/destination-day.png') }}" alt=""> {{$countryvisalist->processing_days}} Business days</div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="container">
                <div class="destination-all"><a href="{{ route('front.populardestinations') }}" class="arrow-btn"><span class="ab-text">View All</span></a></div>
            </div>
        </div>
    </section>
    @endif
    <!-- popular destination end -->
    <!-- type of visa start -->
    <section>
        <div class="container">
            <div class="sec-title">Types Of <span class="color-red">Visa</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
            <div class="desti-title-text typVisa-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. </div>
        </div>
        <div class="type-visa-tab">
            <div class="container">
                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="electronic-tab" data-toggle="pill" href="#electronic" role="tab" aria-controls="electronic" aria-selected="true"><img src="{{asset('images/electronic.png') }}" alt=""> <span>Electronic<br> Visa</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="e-visa-tab" data-toggle="pill" href="#e-visa" role="tab" aria-controls="e-visa" aria-selected="false"><img src="{{asset('images/e-visa.png') }}" alt=""> <span>e-Visa on<br> arrival</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="stamped-tab" data-toggle="pill" href="#stamped" role="tab" aria-controls="stamped" aria-selected="false"><img src="{{asset('images/stamped.png') }}" alt=""> <span>Paper Visa<br> (Stamped)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="in-person-tab" data-toggle="pill" href="#in-person" role="tab" aria-controls="in-person" aria-selected="false"><img src="{{asset('images/in-person.png') }}" alt=""> <span>Paper visa<br> (in person)</span></a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="electronic" role="tabpanel" aria-labelledby="electronic-tab">
                    <div class="container">
                        <div class="how-work">
                            <div class="sec-title sec-title-white"><span class="color-red">How It </span> Works<img src="{{asset('images/plane-right-white.png') }}" alt=""></div>

                            <div class="howWork-text-btn">
                                <div class="desti-title-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego.</div>
                               <!--  <div class="apply-now"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div> -->
                                <a class="arrow-btn yellow-bodr" data-toggle="modal" data-target="#myModal" style="color: #FFF;"><span class="ab-text">Video explainer</span></a>
                            </div>


                            <div class="how-work-row">
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/online-application.png') }}" alt=""></div>
                                    <div class="hwc-title">Fill out Online application form</div>
                                    <div class="hwc-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. </div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/recive-document.png') }}" alt=""></div>
                                    <div class="hwc-title">Recieve Documents via Email</div>
                                    <div class="hwc-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. </div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/enter-desti.png') }}" alt=""></div>
                                    <div class="hwc-title">Enter Destination</div>
                                    <div class="hwc-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. </div>
                                </div>
                            </div>
                            <center>
                                <br>
                             <div class="apply-now"><a href="{{route('front.cost_calculate')}}" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div>
                            </center>
                        </div>
                    </div>
                </div>

                <!-- 2 -->
                <div class="tab-pane fade" id="e-visa" role="tabpanel" aria-labelledby="e-visa-tab">
                    <div class="container">
                    <div class="how-work">
                            <div class="sec-title sec-title-white"><span class="color-red">How It </span> Works<img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                            <div class="howWork-text-btn">
                                <div class="desti-title-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego.</div>
                                <!-- <div class="apply-now"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div> -->
                                <a class="arrow-btn yellow-bodr" data-toggle="modal" data-target="#myModal" style="color: #FFF;"><span class="ab-text">Video explainer</span></a>
                            </div>
                            <div class="how-work-row">
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/online-application.png') }}" alt=""></div>
                                    <div class="hwc-title">Fill out Online application form</div>
                                    <div class="hwc-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. </div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/recive-document.png') }}" alt=""></div>
                                    <div class="hwc-title">Recieve Documents via Email</div>
                                    <div class="hwc-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. </div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/enter-desti.png') }}" alt=""></div>
                                    <div class="hwc-title">Enter Destination</div>
                                    <div class="hwc-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. </div>
                                </div>
                            </div>
                            <center>
                                <br>
                                <div class="apply-now"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div>
                            </center>
                        </div>
                    </div>
                </div>

                <!-- 3 -->
                <div class="tab-pane fade" id="stamped" role="tabpanel" aria-labelledby="stamped-tab">
                    <div class="container">
                        <div class="how-work">
                            <div class="sec-title sec-title-white"><span class="color-red">How It </span> Works<img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                            <div class="howWork-text-btn">
                                <div class="desti-title-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego.</div>
                                <!-- <div class="apply-now"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div> -->
                                <a class="arrow-btn yellow-bodr" data-toggle="modal" data-target="#myModal" style="color: #FFF;"><span class="ab-text">Video explainer</span></a>
                            </div>
                            <div class="how-work-row">
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/electronic-visa-online.png') }}" alt=""></div>
                                    <div class="hwc-title">Fill out Online application</div>
                                    <div class="hwc-text">Complete our easy online application pay with credit card or PayPal</div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/paper-visa-consulate.png') }}" alt=""></div>
                                    <div class="hwc-title">Consulate appointment</div>
                                    <div class="hwc-text">We'll set up your meeting at the consulate. Complete in-person interview and drop off your passport</div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/paper-visa-pickup-passport.png') }}" alt=""></div>
                                    <div class="hwc-title">Pick up passport with visa</div>
                                    <div class="hwc-text">Pick up passport from embassy. Passport will include visa sticker stamp</div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/pay-on-arrival.png') }}" alt=""></div>
                                    <div class="hwc-title">Enter destination</div>
                                    <div class="hwc-text">Present your Passport and the Visa Sticker upon entry to destination country</div>
                                </div>
                            </div>
                            <center>
                                <br>
                                <div class="apply-now"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div>
                            </center>
                        </div>
                    </div>
                </div>

                <!-- 4 -->
                <div class="tab-pane fade" id="in-person" role="tabpanel" aria-labelledby="in-person-tab">
                    <div class="container">
                    <div class="how-work">
                            <div class="sec-title sec-title-white"><span class="color-red">How It </span> Works<img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                            <div class="howWork-text-btn">
                                <div class="desti-title-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego.</div>
                                <!-- <div class="apply-now"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div> -->
                                <a class="arrow-btn yellow-bodr" data-toggle="modal" data-target="#myModal" style="color: #FFF;"><span class="ab-text">Video explainer</span></a>
                            </div>
                            <div class="how-work-row">
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/electronic-visa-online.png') }}" alt=""></div>
                                    <div class="hwc-title">Fill out Online application</div>
                                    <div class="hwc-text">Complete our easy online application pay with credit card or PayPal</div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/paper-visa-consulate.png') }}" alt=""></div>
                                    <div class="hwc-title">Consulate appointment</div>
                                    <div class="hwc-text">We'll set up your meeting at the consulate. Complete in-person interview and drop off your passport</div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/paper-visa-pickup-passport.png') }}" alt=""></div>
                                    <div class="hwc-title">Pick up passport with visa</div>
                                    <div class="hwc-text">Pick up passport from embassy. Passport will include visa sticker stamp</div>
                                </div>
                                <div class="how-work-col">
                                    <div class="hwc-img"><img src="{{asset('images/pay-on-arrival.png') }}" alt=""></div>
                                    <div class="hwc-title">Enter destination</div>
                                    <div class="hwc-text">Present your Passport and the Visa Sticker upon entry to destination country</div>
                                </div>
                            </div>
                            <center>
                                <br>
                                <div class="apply-now"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div>
                            </center>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>
    <!-- type of visa end -->
    <!-- why choose us start -->
    <section class="why-choose">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 col-lg-5">
                    <div class="sec-title">Why <span class="color-red">Choose Us?</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                    <div class="wc-small-text">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.</div>
                    <ul class="why-choose-ul">
                        <li>
                            <div class="title">Innovation</div>
                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.
                        </li>
                        <li>
                            <div class="title">Services</div>
                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.
                        </li>
                        <li>
                            <div class="title">Security</div>
                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.
                        </li>
                        <li>
                            <div class="title">Speed</div>
                            Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs.
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 col-lg-7">
                    <div class="why-choose-img"><img src="{{asset('images/why-choose.png') }}" alt=""></div>
                </div>
            </div>
        </div>
    </section>
    <!-- why choose us end -->
    <!-- about us start -->
    <section class="home-about">
        <div class="home-about-img"><img src="{{asset('images/about-us.png') }}" alt=""></div>
        <div class="home-about-content">
            <div class="sec-title">About <span class="color-red">Us?</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
            @if($about_us)
                {!! Str::words($about_us->description, $words = 100, $end = '...') !!}
            @endif
        </div>
    </section>
    <!-- about us end -->
    <!-- home botm btn start -->
    <section class="container">
        <div class="home-botm-btn">
            <a href="{{route('front.track_your_order')}}" class="arrow-btn"><span class="ab-text">Track your order</span></a>
            <a href="#" class="arrow-btn"><span class="ab-text">Services - visas</span></a>
            <a href="{{ route('front.faq') }}" class="arrow-btn"><span class="ab-text">FAQ</span></a>
        </div>
    </section>
    <!-- home botm btn end -->
</div>

<!-- model Start -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <iframe id="iframeYoutube" width="765" height="400"  src="https://www.youtube.com/embed/e80BbX05D7Y" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Model End -->
@endsection
<!--  -->
