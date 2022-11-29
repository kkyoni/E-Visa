@extends('front.layouts.app')
@section('title', 'No Visa')
@section('mainContent')
    <div class="header-bottom home-banner">
        <div class="banner-content">
            <div class="container">
                <div class="bc-title">Sweden <span class="color-red">Visa</span><br> Information</div>
                <div class="bc-small-text">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</div>
                <div class="form-money">
                {!!
                    Form::open([
                    'route'	=> ['front.checkvisarequirement'],'method'=>'GET',
                    'id'	=> 'checkvisarequirement',
                    'files' => 'true'
                    ])
                !!}
                    <div class="banner-form">
                        <div class="bf-top">
                            <div class="form-group">
                                <label>I am residence of</label>
                                <select class="form-control custom-select " name="residence">
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
                                <select class="form-control custom-select " name="nationality" >
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
                                <select class="form-control custom-select " name="destination">
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

    <div class="mid-start" style="padding: 60px 0;">
        <!-- no visa start -->
        <div class="container visa_required_block ">
            <div class="benefits-to">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="sec-title">No  <span class="color-red">Visa Required</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                        <p>Cheesy feet camembert de normandie danish fontina. Caerphilly pecorino when the cheese comes out everybody's happy pecorino pepper jack pepper jack airedale swiss. Chalk and cheese queso mascarpone edam croque monsieur camembert de normandie rubber cheese camembert de normandie. Macaroni cheese paneer queso cheese on toast cheesecake stilton.</p>
                        <p>Stilton cheeseburger halloumi. Swiss boursin cauliflower cheese caerphilly edam chalk and cheese cut the cheese manchego. Edam boursin blue castello boursin caerphilly red leicester airedale brie. Roquefort swiss stinking bishop.</p>
                    </div>
                    <div class="col-md-6 col-lg-7"><div class="benefits-to-img"><img src="{{asset('images/no-tourist.png') }}" alt=""></div></div>
                </div>
            </div>
        </div>
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
