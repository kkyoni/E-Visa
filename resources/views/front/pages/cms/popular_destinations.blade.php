@extends('front.layouts.app')
@section('title', 'Popular Destinations')
@section('mainContent')
<style type="text/css">
	.blog-box .bb-title{font-size: 30px;}
	.blog-box .bb-subTitle{font-size: 17px; color: #000;}
	.blog-box .bb-subTitle span{color: #f15e2d; font-family: 'Conv_Gotham-Black';font-size: 18px;}
</style>
<div class="container">
    <div class="about-us">
        <div class="sec-title">Popular <span class="color-red">Destinations</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
        {!! html_entity_decode($popular->description, ENT_QUOTES, 'UTF-8') !!}

    </div>
</div>
@endsection