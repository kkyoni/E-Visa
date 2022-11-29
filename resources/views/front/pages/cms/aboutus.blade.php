@extends('front.layouts.app')
@section('title', 'About Us')
@section('mainContent')
<div class="container">
    <div class="about-us">
        <div class="sec-title">About <span class="color-red">Us</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
        {!! html_entity_decode($about_us->description, ENT_QUOTES, 'UTF-8') !!}
    </div>
</div>
@endsection