@extends('front.layouts.app')
@section('title', 'Contact Us')
@section('mainContent')
<div class="container">
    <div class="contact-us">
        <div class="sec-title">Contact us <img src="{{asset('images/plane-right.png') }}" alt=""></div>
        <div class="send-mail">Send us an email</div>
        <div class="contactUs-form">
            {!!  Form::open(['route' => 'front.ContactForm']) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        {!! Form::text('name',null,[
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Name',
                        'id'          => 'name'
                        ]) !!}
                        @if($errors->has('name'))
                        <div class="help-block">
                            <strong>{{ $errors->first('name')  }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        {!! Form::email('email',null,[
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Email',
                        'id'          => 'email'
                        ]) !!}
                        @if($errors->has('email'))
                        <div class="help-block">
                            <strong>{{ $errors->first('email')  }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mobile number</label>
                        {!! Form::text('contact_no',null,[
                        'class'       => 'form-control',
                        'placeholder' => 'Enter Phone Number',
                        'id'          => 'mobile_number', 'maxlength'=>'10'
                        ]) !!}
                        @if($errors->has('contact_no'))
                        <div class="help-block">
                            <strong>{{ $errors->first('contact_no')  }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Country</label>
                        {!! Form::select('country',$country_list,@$country_id,[
                            'class'         => 'form-control select2 custom-select country_id',
                            'tabindex'      => '-1',
                            'aria-hidden'      => 'true',
                            'id'            => 'country',
                            'placeholder'   => 'Select Country',
                            ]) !!}
                        @if($errors->has('country'))
                        <div class="help-block">
                            <strong>{{ $errors->first('country')  }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Message</label>
                        {!! Form::textarea('message',null,[
                        'class'       => 'form-control',
                        'placeholder' => 'Message (Max 500 Char Allowed)',
                        'id'          => 'message',
                        'rows'        => '3', 
                        ]) !!}
                        @if($errors->has('message'))
                        <div class="help-block">
                            <strong>{{ $errors->first('message')  }}</strong>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bf-botm">
                <button type="submit" class="arrow-btn full-width m-b">
                    <span class="ab-text">Send</span>
                    <img src="{{ url('images/right-arrow-white.png')}}" alt="">
                </button>
            </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('styles')
    <style>
        .arrow-btn{border:none}
        .help-block{color: red}
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#mobile_number').on('keyup onmouseout keydown keypress blur change', function (e) {
                var regex = new RegExp("^[0-9 ._\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    return false;
                }
            });

            $(' #name, #country').on('keyup onmouseout keydown keypress blur change', function (event) {
                var regex = new RegExp("^[a-zA-Z ._\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection
