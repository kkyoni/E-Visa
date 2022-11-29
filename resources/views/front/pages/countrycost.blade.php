@extends('front.layouts.app')
@section('title', 'Visa Charges For Country')
@section('mainContent')
    <div class="header-bottom home-banner">
        <div class="banner-content">
            <div class="container">
                <div class="bc-title mb-4">Apply for <span class="color-red">Tourist <br> e-visa</span> From us</div>
                <div class="form-money">
                {!!
                    Form::open([
                    'route' => ['front.checkvisarequirement'],'method'=>'GET',
                    'id'    => 'checkvisarequirement',
                    'files' => 'true'
                    ])
                !!}
                    <div class="banner-form">
                        <div class="bf-top">
                            <div class="form-group">
                                <label>I am residence of</label>
                                <select class="form-control custom-select select2" name="residence" tabindex="1">
                                    <option value="">Please Select</option>
                                    @if(sizeof($countries) > 0)
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}"  @if($residence == $country->id) selected @endif>{{$country->country}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('residence'))
                                    <div class="help-block">
                                        <strong>{{ $errors->first('residence')  }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Nationality as in passport</label>
                                <select class="form-control custom-select select2" name="nationality" tabindex="2">
                                    <option value="">Please Select</option>
                                    @if(sizeof($countries) > 0)
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" @if($nationality == $country->id) selected @endif>{{$country->country}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('nationality'))
                                    <div class="help-block">
                                        <strong>{{ $errors->first('nationality')  }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Travelling to</label>
                                <select class="form-control custom-select select2" name="destination" tabindex="3">
                                    <option value="">Please Select</option>
                                    @if(sizeof($countries) > 0)
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" @if($destination == $country->id) selected @endif>{{$country->country}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('destination'))
                                    <div class="help-block">
                                        <strong>{{ $errors->first('destination')  }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="bf-botm">
                            <button class="arrow-btn" type="submit" style="border: none;"><span class="ab-text">Check Availability</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </header>
    <!-- header end -->
    <!-- mid part start -->
    <div class="mid-start">

        <section class="visa-detail">
            <div class="container">
                <div class="sec-title sec-title-white">Visa <span class="color-red">Details</span> <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                <div class="multiple-entry">
                    <div class="row d-flex align-items-center table-responsive visa_cost_block">
                        @if(!empty($visadetail))
                        @foreach($visadetail as $fee)
                        @foreach($fee->CountryVisa as $Country_list)
                        <div class="col-md-4">
                            <div class="visa-detail-box">
                                <!-- <span>Valid for {{$Country_list->processing_day}} Days</span> -->
                                <div class="bdb-title">{{$fee->visatype->visa_type}}</div>
                                <span>{{$Country_list->visatypeentry->visa_type_entry}} Entry</span>
                                <span class="govt-fee">Government Fee</span>
                                <div class="bdb-title">AED {{$Country_list->regular_gov_fee}}</div>
                                
                                {!!  Form::open(['route'    => ['front.apply_now_form'], 'method'=>"GET"])  !!}
                                <input type="hidden" name="regular_gov_fee"  value="{{$Country_list->regular_gov_fee}}">
                                <input type="hidden" name="processing_fee"  value="{{$Country_list->processing_day}}">
                                <input type="hidden" name="visa_detail_id" value="{{ $Country_list->country_visa_id  }}">
                                <input type="hidden" name="nationality_id" value="{{$nationality}}">
                                <input type="hidden" name="from_country_id" value="{{$residence}}">
                                <input type="hidden" name="destination_country_id" value="{{$destination}}">
                                <input type="hidden" name="visa_type_id" value="{{ $fee->visa_type_id  }}">
                                <input type="hidden" name="visa_entry_id"  value="{{$Country_list->visa_type_entry_id}}">
                                <button class="arrow-btn yellow-bodr" type="submit" style="border: none; margin-top: 15px"><span class="ab-text" style="color:#FFF;">Continue</span></button>
                                <!-- @if(\Auth::check()) -->
                                <!-- @else
                                <a href="#login-modal" data-toggle="modal" class="arrow-btn yellow-bodr" style="border: none; margin-top: 15px"><span class="ab-text" style="color:#FFF;">Continue</span></a>
                                @endif -->
                                {!! Form::close() !!}

                            </div>
                        </div>
                        @endforeach
                        @endforeach
                        @else
                        <div class="col-md-12" style="text-align: center; color: #0f4373; font-size: 22px; line-height: 25px; font-family: 'Conv_Gotham-Black'; padding-bottom:9px;">
                        <div>No results found</div>
                        </div>
                        @endif

                    </div>                
                </div>
            </div>
        </section>

        
        <div class="how-work how-apply">
            <div class="container">
                <div class="sec-title "> How To Apply <span class="color-red">Toursit E-Visa</span><img src="{{asset('images/plane-right.png') }}" alt=""></div>
                <div class="howWork-text-btn">
                    <div class="desti-title-text">Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego.</div>
                    <div class="apply-now"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div>
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
            </div>
        </div>

        <div class="documents-required">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sec-title">Documents Required For <br> <span class="color-red">Toursit E-Visa</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                        <ul class="documents-required-ul">
                            <li>Cheesy feet camembert de normandie danish fontina. </li>
                            <li>Caerphilly pecorino when the cheese comes out everybody's happy pecorino pepper jack pepper jack airedale swiss.</li>
                            <li>Chalk and cheese queso mascarpone edam croque monsieur camembert de normandie   rubber cheese camembert de normandie. Macaroni cheese paneer queso cheese on toast cheesecake stilton.</li>
                            <li>Stilton cheeseburger halloumi. </li>
                            <li>Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego.</li>
                            <li>Edam boursin blue castello boursin caerphilly red leicester airedale brie. Roquefort swiss
                                stinking bishop.</li>
                        </ul>
                        <div class="documents-required-btn"><a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Apply now</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="information-about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-7"><div class="information-about-img"><img src="{{asset('images/information-about.png') }}" alt=""></div></div>
                    <div class="col-md-6 col-lg-5">
                        <div class="sec-title">Information About <br> <span class="color-red">Toursit E-Visa</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                        <p>Cheesy feet camembert de normandie danish fontina. Caerphilly pecorino when the cheese comes out everybody's happy pecorino pepper jack pepper jack airedale swiss. Chalk and cheese queso mascarpone edam croque monsieur camembert de normandie rubber cheese camembert de normandie. Macaroni cheese paneer queso cheese on toast cheesecake stilton.</p>
                        <p>Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. Edam boursin blue castello boursin caerphilly red leicester airedale brie. Roquefort swiss stinking bishop.</p>
                    </div>
                </div>
            </div>
        </div>
        

        <section class="client-say">
            <div class="container">
                <div class="sec-title">What <span class="color-red">Our Clients</span> Say <img src="{{asset('images/plane-right.png') }}" alt=""></div>
            </div>
            <div class="client-say-row">
                <div class="slider cs-slider">
                    <div>
                        <div class="client-say-col">
                            <div class="hover-boder"></div>
                            <div class="client-say-box">
                                <div class="csb-top">
                                    <div class="client-img"><img src="{{asset('images/client-say.jpg') }}" alt=""></div>
                                    <div class="name-country">
                                        <div class="name">Jhon Smith</div>
                                        <div class="country">USA</div>
                                        <div class="rating"><img src="{{asset('images/say-client-rating.png') }}" alt=""></div>
                                    </div>
                                </div>
                                <div class="bsb-botm">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century.</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="client-say-col">
                            <div class="hover-boder"></div>
                            <div class="client-say-box">
                                <div class="csb-top">
                                    <div class="client-img"><img src="{{asset('images/client-say.jpg') }}" alt=""></div>
                                    <div class="name-country">
                                        <div class="name">Jhon Smith</div>
                                        <div class="country">USA</div>
                                        <div class="rating"><img src="{{asset('images/say-client-rating.png') }}" alt=""></div>
                                    </div>
                                </div>
                                <div class="bsb-botm">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century.</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="client-say-col">
                            <div class="hover-boder"></div>
                            <div class="client-say-box">
                                <div class="csb-top">
                                    <div class="client-img"><img src="{{asset('images/client-say.jpg') }}" alt=""></div>
                                    <div class="name-country">
                                        <div class="name">Jhon Smith</div>
                                        <div class="country">USA</div>
                                        <div class="rating"><img src="{{asset('images/say-client-rating.png') }}" alt=""></div>
                                    </div>
                                </div>
                                <div class="bsb-botm">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century.</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="client-say-col">
                            <div class="hover-boder"></div>
                            <div class="client-say-box">
                                <div class="csb-top">
                                    <div class="client-img"><img src="{{asset('images/client-say.jpg') }}" alt=""></div>
                                    <div class="name-country">
                                        <div class="name">Jhon Smith</div>
                                        <div class="country">USA</div>
                                        <div class="rating"><img src="{{asset('images/say-client-rating.png') }}" alt=""></div>
                                    </div>
                                </div>
                                <div class="bsb-botm">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century.</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="client-say-col">
                            <div class="hover-boder"></div>
                            <div class="client-say-box">
                                <div class="csb-top">
                                    <div class="client-img"><img src="{{asset('images/client-say.jpg') }}" alt=""></div>
                                    <div class="name-country">
                                        <div class="name">Jhon Smith</div>
                                        <div class="country">USA</div>
                                        <div class="rating"><img src="{{asset('images/say-client-rating.png') }}" alt=""></div>
                                    </div>
                                </div>
                                <div class="bsb-botm">Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <div class="mid-start">
    <section class="faq">
        <div class="container">
            <div class="sec-title">FAQ  
                <img src="{{asset('images/plane-right.png') }}" alt="">
            </div>
            @if(count($faq_list)>0)
            <div class="faq-acoordion">
                <div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                    @foreach($faq_list as $key => $faq_listing)
                    <div class="card">
                            <a class="collapsed acoo-title" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo{{$key}}" aria-expanded="@if($key == '0') true @else false @endif" aria-controls="collapseTwo{{$key}}">{!! html_entity_decode($faq_listing->question, ENT_QUOTES, 'UTF-8') !!}<span class="acoo-arrow"><img src="{{asset('images/select-arrow.png') }}" alt=""></span></a>
                            <div id="collapseTwo{{$key}}" class="collapse @if($key == '0') show @else  @endif" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                                <div class="card-body">
                                {!! html_entity_decode($faq_listing->answer, ENT_QUOTES, 'UTF-8') !!}
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
                <div class="faq-acoordion">
                    <div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <a class="collapsed acoo-title" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="acoo-arrow" style="text-align: center;"><b>Data Record Not Found</b></span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
@section('styles')
    <style>
        .hidden{ display: none !important; }
        .mid-start{padding: 0;}
        .multiple-entry .visa-detail-box:hover{border: 1px solid #f15e2d;}
    </style>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.check_available').on('click', function () {
                var from_country = $(".from_country").val();
                var destination_country = $(".destination_country").val();

                if(destination_country && from_country){
                    $.ajax({
                        url:"{{ route('front.checkvisa') }}",
                        type: 'post',
                        data: {
                            "_method": 'post',
                            'destination_country':destination_country, 'from_country': from_country,
                            "_token": "{{ csrf_token() }}"
                        },
                        success:function(result){
                            if(result.result === true){
                                $('.visa_required_block').removeClass('hidden');
                            }else{
                                if(!$('.visa_required_block').hasClass("hidden")){
                                    $('.visa_required_block').addClass('hidden');
                                }
                            }
                        },
                        error:function(){
                            swal("Error!", 'Error in updated Record', "error");
                        }
                    });
                }else{
                    alert('Residence, Nationality and Travelling to Country is Mandatory');
                }
            });
        });
    </script>
@endsection
