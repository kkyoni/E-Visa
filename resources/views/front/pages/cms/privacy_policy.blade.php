@extends('front.layouts.app')
@section('title', 'Privacy Policy')
@section('mainContent')
<div class="container">
    <div class="about-us">
        <div class="sec-title">
            <span class="color-red">Privacy </span> Policy
            <img src="{{asset('images/plane-right.png') }}" alt="">
        </div>
{!! html_entity_decode($privacy->description, ENT_QUOTES, 'UTF-8') !!}
    </div>
</div>
@endsection
