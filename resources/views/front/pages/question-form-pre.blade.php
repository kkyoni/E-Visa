@extends('front.layouts.app')
@section('title', 'No Visa')
@section('mainContent')

    <div class="header-bottom home-banner">
        <div class="banner-content">
            <div class="container">
                <div class="bc-title">Travel <span class="color-red">Visa</span> <br> Requirements</div>
                <div class="bc-small-text">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</div>
            </div>
        </div>
    </div>
    </header>
    <!-- mid part start -->
    <div class="mid-start" style="padding: 60px 0;">
        <!-- question form start -->
        <div class="container">
            <div class="question-form">
                <div class="qf-title">Fill out the following form to complete your application for Visa</div>
                @if($errors->has('user_answer'))
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('user_answer') ? "".$errors->first('user_answer')."" : '' }} </font>
                    </span>
                @endif
                {!!
                Form::open([
                'route'	=> ['front.submituserans'],
                'id'	=> 'userCreateForm',
                'files' => 'true'
                ])
                !!}

                <div class="qf-radio-col">
                    <input type="hidden" name="application_id" value="{{@$application_id}}">
                    @if(sizeof($questions) > 0)
                        @foreach($questions as $key => $que)
                            <div class="qf-radio-row">
                                <div class="qf-row-title">
                                    {{  $que->question }}
                                    <input type="hidden" name="question_id[]" value="{{ $que->id  }}">
                                </div>
                                <div class="qf-radio">
                                    @if($que->answer_type === 'text')
                                        <div class=" col-md-6">
                                            <input type="text" name="user_answer[]" id="textanswer" class="form-control" placeholder="Enter Your Answer" required>
                                        </div>
                                    @elseif($que->answer_type === 'datepicker')
                                        <div class="col-md-6">
                                            <div class='input-group date datetimepicker' id='datetimepicker'>
                                                <input type='text' class="form-control arrival_date" id="arrival_date" name="user_answer[]" required placeholder="Select Date"  />
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    @elseif($que->answer_type === 'drop-down')
                                        <div class=" col-md-6" title="{{ $que->tooltip  }}">
{{--                                            <input type="text" name="user_answer[]" id="dropdown" class="form-control" placeholder="Enter Answer" required>--}}
                                            {!! Form::select('user_answer[]',['yes' => 'Yes','no' => 'No'],null,['class' => 'form-control answer_type_drop','id'  => 'answer_type_drop','placeholder'   => 'Please Select']) !!}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if(isset($que->sub_question))
                                <div class="qf-radio-row sub_question_block hidden">
                                    <div class="qf-row-title" title="{{ $que->sub_tooltip  }}">
                                        {{  $que->sub_question }}
                                        <span class="row col-md-12" style="font-size: 12px;">{{  $que->sub_note }}</span>
                                        <input type="hidden" name="sub_que[]" value="{{ $que->sub_question  }}">
                                        <input type="hidden" name="sub_que_index" value="{{ $key  }}">
                                    </div>
                                    <div class="qf-radio">
                                        <div class=" col-md-6">
                                            @if($que->sub_ans_type === 'text')
                                                <input type="text" name="sub_ans[]" id="textanswer" class="form-control" placeholder="Enter Your Answer" required>
                                            @elseif($que->sub_ans_type === 'datepicker')
                                                <input type='text' class="form-control arrival_date" id="arrival_date" name="sub_ans[]" required placeholder="Select Date"  />
                                            @elseif($que->sub_ans_type === 'drop-down')
                                                {!! Form::select('sub_ans[]',['yes' => 'Yes','no' => 'No'],null,['class' => 'form-control sub_ans_drop','id'  => 'sub_ans_drop','placeholder'   => 'Please Select']) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if(isset($que->last_question))
                                <div class="qf-radio-row last_question_block hidden">
                                    <div class="qf-row-title">
                                        {{  $que->last_question }}
                                        <input type="hidden" name="last_que" value="{{ $que->last_question  }}">
                                        <input type="hidden" name="last_que_index" value="{{ $key  }}">
                                    </div>
                                    <div class="qf-radio">
                                        <div class=" col-md-6">
                                            @if($que->last_ans_type === 'text')
                                                <input type="text" name="last_ans" id="textlastanswer" class="form-control" placeholder="Enter Your Answer" >
                                            @elseif($que->last_ans_type === 'datepicker')
                                                <input type='text' class="form-control arrival_date" name="last_ans" id="textlastanswer"  required placeholder="Select Date"  />
                                            @elseif($que->last_ans_type === 'drop-down')
                                                {!! Form::select('last_ans',['yes' => 'Yes','no' => 'No'],null,['class' => 'form-control','id'  => 'last_dropdown','placeholder'   => 'Please Select']) !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                @if(sizeof($questions) > 0)
                    <div class="qf-btn">
                        <button class="arrow-btn" type="submit"><span class="ab-text">Submit</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></button>
                    </div>
                @endif
                {!! Form::close() !!}
            </div>
        </div>
        <!-- question form start -->
    </div>
@endsection
@section('styles')
    <style>
        .hidden{ display: none !important; }
        .mid-start{padding: 0;}
    </style>
@endsection
@section('scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $( "#datepicker_ans" ).datepicker({
            changeMonth: true,
            changeYear: true,
            maxDate: 0
        });
        $(document).ready(function () {
            $('#electronic-tab').on('click', function () {
                $('#service_type').val('regular');
            });
            $('#e-visa-tab, .nav-express').on('click', function () {
                $('#service_type').val('express');
            });
        });
    </script>

    <!-- datetime picker -->
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <!-- datetime picker -->
    <script type="text/javascript">
        $(function() {
            $('.datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY',
            });

            $('.datetimepicker').on('keyup onmouseout keydown keypress blur change', function (event) {
                var regex = new RegExp("^[\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
        });

        $('#answer_type_drop').on('change', function () {
            var val = $(this).val();
            if(val == 'no'){
                $('.sub_question_block').removeClass('hidden');
            }else{
                if(!$('.sub_question_block, .last_question_block').hasClass('hidden')){
                    $('.sub_question_block, .last_question_block').addClass('hidden');
                }
            }
        });

        $('#sub_ans_drop').on('change', function () {
            var val = $(this).val();
            if(val == 'no'){
                $('.last_question_block').removeClass('hidden');
            }else{
                if(!$('.last_question_block').hasClass('hidden')){
                    $('.last_question_block').addClass('hidden');
                }
            }
        });

    </script>
@endsection
