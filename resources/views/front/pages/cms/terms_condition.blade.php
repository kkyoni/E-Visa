@extends('front.layouts.app')
@section('title', 'Terms Condition')
@section('mainContent')
        <div class="container">
            <div class="about-us">
                <div class="sec-title">Terms <span class="color-red">And Condition</span> <img src="images/plane-right.png" alt=""></div>

                 {!! html_entity_decode($terms->description, ENT_QUOTES, 'UTF-8') !!}
            </div>
        </div>
   @endsection