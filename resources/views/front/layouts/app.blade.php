<!doctype html>
<!--[if IE 9]><html class="ie9" lang="en"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
@include('front.includes.head')
<body>
    <script type="text/javascript">{{App\Script::get('body_script')}}</script> 
    @include('front.includes.topNavigation')
    <?php 
    $routeName = Request::route()->getName();
    ?>
    <div class="header-bottom @if($routeName == 'front.index') home-banner @endif">
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <a class="navbar-brand" href="{{route('front.index')}}"><img src="{{ url(\Settings::get('slider_logo')) }}" alt=""></a>
                <button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
                    <span> </span>
                    <span> </span>
                    <span> </span>
                </button>
                <div class="collapse navbar-collapse" id="collapsingNavbar">
                    <ul class="navbar-nav ml-auto">
                        @if(\Auth::check())
                            <li class="nav-item active"><a class="nav-link" href="{{route('front.apply_now')}}">Apply For Visa</a></li>
                        @else
                            <li class="nav-item active"><a href="#login-modal" data-toggle="modal" class="nav-link" >Apply For Visa</a></li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('front.track_your_order')}}">Track Order Status </a>
                        </li>
                        @if(\Auth::check())
                            <li class="nav-item active"><a class="nav-link" href="{{route('front.offerdiscount')}}">Offer/Discounts</a></li>
                        @else
                            <li class="nav-item active"><a href="#login-modal" data-toggle="modal" class="nav-link" >Offer/Discounts</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{route('front.cost_calculate')}}">Cost Calculate</a></li>
                        <li class="nav-item"><a class="nav-link menu-contact" href="{{route('front.contact')}}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        @if($routeName == 'front.index')
        <div class="banner-content">
        <div class="container">
            <div class="bc-title">Travel <span class="color-red">Visa</span><br> Requirements</div>
            <div class="bc-small-text">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</div>
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
                            <select class="form-control select2 custom-select" tabindex="1" name="residence">
                            <!-- <select class="form-control select2 custom-select" name="residence" tabindex="-1" aria-hidden="true"> -->
                                <option value="">Please Select</option>
                                @if(sizeof($countries) > 0)
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->country}}</option>
                                @endforeach
                                @endif
                            </select>
                            @if($errors->has('residence'))
                            <div class="help-block">
                                <strong style="color:red;">{{ $errors->first('residence')  }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nationality as in passport</label>
                            <select class="form-control select2 custom-select" tabindex="2" name="nationality">
                            <!-- <select class="form-control select2 custom-select" name="nationality"  tabindex="-1" aria-hidden="true"> -->
                                <option value="">Please Select</option>
                                @if(sizeof($countries) > 0)
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->country}}</option>
                                @endforeach
                                @endif
                            </select>
                            @if($errors->has('nationality'))
                            <div class="help-block">
                                <strong style="color:red;">{{ $errors->first('nationality')  }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Travelling to</label>
                            <select class="form-control select2 custom-select" tabindex="3" name="destination">
                            <!-- <select class="form-control select2 custom-select" name="destination"  tabindex="-1" aria-hidden="true"> -->
                                <option value="">Please Select</option>
                                @if(sizeof($countries) > 0)
                                @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->country}}</option>
                                @endforeach
                                @endif
                            </select>
                            @if($errors->has('destination'))
                            <div class="help-block">
                                <strong style="color:red;">{{ $errors->first('destination')  }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="bf-botm">
                        <!-- <a href="#login-modal" class="arrow-btn" data-toggle="modal"><span class="ab-text">Return customer</span> <img src="{{asset('images/right-arrow-white.png')}}" alt=""></a> -->
                        <button class="arrow-btn" type="submit" style="border: none;"><span class="ab-text">Check Availability</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></button>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="money-back"><img src="images/money-back.png" alt=""></div>
            </div>
        </div>
    </div>
@endif

    </div>
</header>
    <div class="mid-start">
    @yield('mainContent')
    </div>
    @include('front.includes.footer')
    @include('front.includes.scripts')
 </body>
</html>
