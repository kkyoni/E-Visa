@extends('front.layouts.app')
@section('title', 'Payment Terms')
@section('mainContent')
        <div class="container">
            <div class="about-us">
                <div class="sec-title">Payment <span class="color-red">Terms</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                {!! html_entity_decode($payment->description, ENT_QUOTES, 'UTF-8') !!}
            </div>
        </div>
        @endsection