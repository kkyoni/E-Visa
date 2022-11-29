<div class="form-group row {{ $errors->has('country_id') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Select Country</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-3">
        {!! Form::select('country_id',$country_list,null,[
        'class'         => 'form-control',
        'id'            => 'country_id',
        'placeholder'   => 'Country Name','required'
        ]) !!}
        <span class="help-block">
                <font color="red"> {{ $errors->has('country_id') ? "".$errors->first('country_id')."" : '' }} </font>
            </span>
    </div>
    <label class="col-sm-3 col-form-label text-right">
        <strong>Select Visa</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-3">
        {!! Form::select('visa',
        $visa_types,
        @$pre->visa,
        ['class' => 'form-control','id'  => 'availability',
        'placeholder'   => 'Select Visa '
        ]) !!}
        <span class="help-block">
                <font color="red"> {{ $errors->has('visa') ? "".$errors->first('visa')."" : '' }} </font>
            </span>
    </div>
</div>

@if(!empty($prepostpayment->pre_list))
    <?php $i ="1"; ?>
    @foreach($prepostpayment->pre_list as $pre_list_user)
        <div class="form-group row {{ $errors->has('question') ? 'has-error' : '' }}">
            <label class="col-sm-3 col-form-label">
                <strong>Question</strong>
                <span class="text-danger">*</span>
            </label>
            <div class="col-sm-9">
                {!! Form::text('question',$pre_list_user->question,[
                'class' => 'form-control ',
                'id'    => 'question', 'placeholder' => 'Question'
                ]) !!}
                <span class="help-block">
                <font color="red"> {{ $errors->has('question') ? "".$errors->first('question')."" : '' }} </font>
            </span>
            </div>
        </div>

        <div class="form-group row {{ $errors->has('answer_type') ? 'has-error' : '' }}">
            <label class="col-sm-3 col-form-label">
                <strong>Answer Type</strong>
                <span class="text-danger">*</span>
            </label>
            <div class="col-sm-9">
                {!! Form::select('answer_type',
                ['text' => 'Text','drop-down' => 'Drop-Down','datepicker'=>'Datepicker'],
                @$pre_list_user->answer_type,
                ['class' => 'form-control','id'  => 'answer_type',
                'placeholder'   => 'Select Answer Type'
                ]) !!}
                <span class="help-block">
                <font color="red"> {{ $errors->has('answer_type') ? "".$errors->first('answer_type')."" : '' }} </font>
            </span>
            </div>
        </div>


        <div class="dropdownblock @if(@$pre_list_user->answer_type !== 'drop-down') hidden @endif">
            <div class="form-group row {{ $errors->has('add_droup') ? 'has-error' : '' }}">
                <label class="col-sm-3 col-form-label">
                    <strong>Add Drop Down Option</strong>
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-3">
                    {!! Form::select('add_droup',
                    ['yes' => 'Yes','no' => 'No'],
                    @$pre_list_user->add_droup,
                    ['class' => 'form-control','id'  => 'add_dropdown',
                    'placeholder'   => 'Please Select'
                    ]) !!}
                    <span class="help-block">
                <font color="red"> {{ $errors->has('add_droup') ? "".$errors->first('add_droup')."" : '' }} </font>
            </span>
                </div>
                <label class="col-sm-1 col-form-label">
                    <strong>Note</strong>
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-2">
                    {!! Form::text('note',$pre_list_user->note,[
                    'class' => 'form-control ',
                    'id'    => 'Note'
                    ]) !!}
                    <span class="help-block">
                <font color="red"> {{ $errors->has('Note') ? "".$errors->first('Note')."" : '' }} </font>
            </span>
                </div>

                <div class="col-sm-3">
                    <input type="checkbox" name="proceed" id="proceed" value="{{$pre_list_user->proceed}}" @if(@$pre_list_user->proceed) checked @endif>
                    <span class="help-block">
                <font color="red"> {{ $errors->has('proceed') ? "".$errors->first('proceed')."" : '' }} </font>
            </span>
                    <label class="col-sm-6 col-form-label" for="proceed">
                        <strong>Proceed</strong>
                        <span class="text-danger">*</span>
                    </label>
                </div>
            </div>

            <div class="form-group row {{ $errors->has('tooltip') ? 'has-error' : '' }}">
                <label class="col-sm-3 col-form-label">
                    <strong>Tooltip</strong>
                    <span class="text-danger">*</span>
                </label>
                <div class="col-sm-9">
                    {!! Form::text('tooltip',$pre_list_user->tooltip,[
                    'class' => 'form-control ',
                    'id'    => 'tooltip'
                    ]) !!}
                    <span class="help-block">
                    <font color="red"> {{ $errors->has('tooltip') ? "".$errors->first('tooltip')."" : '' }} </font>
                </span>
                </div>
            </div>
        </div>

        <div class="input_fields_wrap @if(@$pre_list_user->add_droup !== 'no') hidden @endif">
            <div class="remove_test">
                <div class="hr-line-dashed"></div>
                <p><u>Sub Question for 'No'</u></p>
                <div class="form-group row {{ $errors->has('sub_question') ? 'has-error' : '' }}">
                    <label class="col-sm-3 col-form-label"><strong>Question</strong><span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        {!! Form::text('sub_question',@$pre_list_user->sub_question->sub_question,['class' => 'form-control ','id'    => 'sub_question', 'placeholder' => 'Question']) !!}
                        <span class="help-block">
                        <font color="red"> {{ $errors->has('sub_question') ? "".$errors->first('sub_question')."" : '' }} </font>
                    </span>
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="col-sm-3 col-form-label">
                        <strong>Answer Type</strong>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        {!! Form::select('sub_answer_type',
                        ['text' => 'Text','drop-down' => 'Drop-Down','datepicker'=>'Datepicker'],
                        @$pre_list_user->sub_question->sub_answer_type,
                        ['class' => 'form-control','id'  => 'sub_answer_type',
                        'placeholder'   => 'Select Answer Type'
                        ]) !!}
                        <span class="help-block">
                        <font color="red">  {{ $errors->has('sub_answer_type') ? "".$errors->first('sub_answer_type')."" : '' }}</font>
                    </span>
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('sub_add_droup') ? 'has-error' : '' }}">
                    <label class="col-sm-3 col-form-label"><strong>Add Drop Down Option</strong>
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                        {!! Form::select('sub_add_drop',['yes' => 'Yes','no' => 'No'],@$pre_list_user->sub_add_drop,['class' => 'form-control','id'  => 'add_sub_drop_down','placeholder'   => 'Add Drop']) !!}
                        <span class="help-block">
                        <font color="red"> {{ $errors->has('sub_add_drop') ? "".$errors->first('sub_add_drop')."" : '' }} </font>
                    </span>
                    </div>
                    <label class="col-sm-1 col-form-label"><strong>Note</strong><span class="text-danger">*</span></label>
                    <div class="col-sm-2">{!! Form::text('sub_note',@$pre_list_user->sub_note,['class' => 'form-control ','id'    => 'Note']) !!}
                        <span class="help-block">
                        <font color="red"> {{ $errors->has('sub_note') ? "".$errors->first('sub_note')."" : '' }} </font>
                    </span>
                    </div>
                    <div class="col-sm-3">
                        <input type="checkbox" name="sub_proceed" value="0" id="sub_proceed" @if(@$pre_list_user->sub_proceed) checked @endif>
                        <span class="help-block">
                        <font color="red"> {{ $errors->has('sub_proceed') ? "".$errors->first('sub_proceed')."" : '' }} </font>
                    </span>
                        <label class="col-sm-6 col-form-label" for="sub_proceed"><strong>Proceed</strong>
                            <span class="text-danger">*</span>
                        </label>
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('sub_tooltip') ? 'has-error' : '' }}">
                    <label class="col-sm-3 col-form-label"><strong>Tooltip</strong><span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        {!! Form::text('sub_tooltip',@$pre_list_user->sub_tooltip,['class' => 'form-control ','id'    => 'sub_tooltip']) !!}
                        <span class="help-block">
                        <font color="red"> {{ $errors->has('sub_tooltip') ? "".$errors->first('sub_tooltip')."" : '' }} </font>
                    </span>
                    </div>
                </div>

                @if(@$pre_list_user->last_question)
                    <div class=" ques_ans_block" style="">
                        <hr style="border: 1px dashed #ccc;">
                        <div class="form-group row {{ $errors->has('last_question') ? 'has-error' : '' }}">
                            <label class="col-sm-3 col-form-label">
                                <strong>Question</strong>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text('last_question',@$pre_list_user->last_question,[
                                'class' => 'form-control ',
                                'id'    => 'last_question', 'placeholder' => 'Question'
                                ]) !!}
                                <span class="help-block">
                            <font color="red"> {{ $errors->has('last_question') ? "".$errors->first('question')."" : '' }} </font>
                        </span>
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('last_ans_type') ? 'has-error' : '' }}">
                            <label class="col-sm-3 col-form-label">
                                <strong>Answer</strong>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                {!! Form::select('last_ans_type',
                                ['text' => 'Text','datepicker'=>'Datepicker'],
                                @$pre_list_user->last_ans_type,
                                ['class' => 'form-control','id'  => 'last_ans_type',
                                'placeholder'   => 'Select Answer Type'
                                ]) !!}
                                <span class="help-block">
                            <font color="red"> {{ $errors->has('answer') ? "".$errors->first('answer')."" : '' }} </font>
                        </span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="hidden ques_ans_block" style="">
                        <hr style="border: 1px dashed #ccc;">
                        <div class="form-group row {{ $errors->has('last_question') ? 'has-error' : '' }}">
                            <label class="col-sm-3 col-form-label">
                                <strong>Question</strong>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                {!! Form::text('last_question',null,[
                                'class' => 'form-control ',
                                'id'    => 'last_question', 'placeholder' => 'Question'
                                ]) !!}
                                <span class="help-block">
                            <font color="red"> {{ $errors->has('last_question') ? "".$errors->first('question')."" : '' }} </font>
                        </span>
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('last_ans_type') ? 'has-error' : '' }}">
                            <label class="col-sm-3 col-form-label">
                                <strong>Answer</strong>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-9">
                                <select class="form-control" id="last_ans_type" name="last_ans_type">
                                    <option selected="selected" value="">Select Answer Type</option>
                                    <option value="text">Text</option>
                                    <option value="datepicker">Datepicker</option>
                                </select>
                                <span class="help-block">
                            <font color="red"> {{ $errors->has('answer') ? "".$errors->first('answer')."" : '' }} </font>
                        </span>
                            </div>
                        </div>
                    </div>
                @endif


                <div style="cursor:pointer;" class="remove_field btn btn-danger">Remove</div>
            </div>
        </div>
        <br>
        <button style="background-color:green;" class="add_field_button btn btn-info active hidden">Add Sub Question</button>
        <br>
        <br>
        <?php $i ++; ?>
    @endforeach
@else

    <div class="form-group row {{ $errors->has('question') ? 'has-error' : '' }}">
        <label class="col-sm-3 col-form-label">
            <strong>Question</strong>
            <span class="text-danger">*</span>
        </label>
        <div class="col-sm-9">
            {!! Form::text('question',null,[
            'class' => 'form-control ',
            'id'    => 'question', 'placeholder' => 'Question'
            ]) !!}
            <span class="help-block">
            <font color="red"> {{ $errors->has('question') ? "".$errors->first('question')."" : '' }} </font>
        </span>
        </div>
    </div>

    <div class="form-group row {{ $errors->has('answer_type') ? 'has-error' : '' }}">
        <label class="col-sm-3 col-form-label">
            <strong>Answer Type</strong>
            <span class="text-danger">*</span>
        </label>
        <div class="col-sm-9">
            {!! Form::select('answer_type',
            ['text' => 'Text','drop-down' => 'Drop-Down','datepicker'=>'Datepicker'],
            @$pre->answer_type,
            ['class' => 'form-control','id'  => 'answer_type',
            'placeholder'   => 'Select Answer Type'
            ]) !!}
            <span class="help-block">
            <font color="red"> {{ $errors->has('answer_type') ? "".$errors->first('answer_type')."" : '' }} </font>
        </span>
        </div>
    </div>

    <div class="dropdownblock hidden">
        <div class="form-group row {{ $errors->has('add_droup') ? 'has-error' : '' }}">
            <label class="col-sm-3 col-form-label">
                <strong>Add Drop Down Option</strong>
                <span class="text-danger">*</span>
            </label>
            <div class="col-sm-3">
                {!! Form::select('add_droup', ['yes' => 'Yes','no' => 'No'],
                @$pre->add_droup,['class' => 'form-control','id'  => 'add_dropdown','placeholder'   => 'Please Select'
                ]) !!}
                <span class="help-block">
                <font color="red"> {{ $errors->has('add_droup') ? "".$errors->first('add_droup')."" : '' }} </font>
            </span>
            </div>
            <label class="col-sm-1 col-form-label">
                <strong>Note</strong>
                <span class="text-danger">*</span>
            </label>
            <div class="col-sm-2">
                {!! Form::text('note',null,[
                'class' => 'form-control ',
                'id'    => 'Note'
                ]) !!}
                <span class="help-block">
                <font color="red"> {{ $errors->has('Note') ? "".$errors->first('Note')."" : '' }} </font>
            </span>
            </div>

            <div class="col-sm-3">
                <input type="checkbox" name="proceed" id="proceed" value="0">
                <span class="help-block">
                <font color="red"> {{ $errors->has('proceed') ? "".$errors->first('proceed')."" : '' }} </font>
            </span>
                <label class="col-sm-6 col-form-label" for="proceed">
                    <strong>Proceed</strong>
                    <span class="text-danger">*</span>
                </label>
            </div>
        </div>

        <div class="form-group row {{ $errors->has('tooltip') ? 'has-error' : '' }}">
            <label class="col-sm-3 col-form-label">
                <strong>Tooltip</strong>
                <span class="text-danger">*</span>
            </label>
            <div class="col-sm-9">
                {!! Form::text('tooltip',null,[
                'class' => 'form-control ',
                'id'    => 'tooltip'
                ]) !!}
                <span class="help-block">
                <font color="red"> {{ $errors->has('tooltip') ? "".$errors->first('tooltip')."" : '' }} </font>
            </span>
            </div>
        </div>
        <div class="input_fields_wrap hidden">
            <div class="remove_test">
                <div class="hr-line-dashed"></div>
                <p><u>Sub Question for  'No'</u></p>
                <div class="form-group row {{ $errors->has('sub_question') ? 'has-error' : '' }}">
                    <label class="col-sm-3 col-form-label"><strong>Question</strong><span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        {!! Form::text('sub_question',null,['class' => 'form-control ','id'    => 'sub_question', 'placeholder' => 'Question']) !!}
                        <span class="help-block">
                        <font color="red"> {{ $errors->has('sub_question') ? "".$errors->first('sub_question')."" : '' }} </font>
                    </span>
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="col-sm-3 col-form-label">
                        <strong>Answer Type</strong>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-9">
                        <select class="form-control" id="sub_answer_type" name="sub_ans_type">
                            <option selected="selected" value="">Select Answer Type</option>
                            <option value="text">Text</option>
                            <option value="drop-down">Drop-Down</option>
                            <option value="datepicker">Datepicker</option>
                        </select>
                        <span class="help-block">
                        <font color="red">  {{ $errors->has('sub_ans_type') ? "".$errors->first('sub_ans_type')."" : '' }}</font>
                    </span>
                    </div>
                </div>

                <div class="sub_dropdown_block hidden">
                    <div class="form-group row {{ $errors->has('sub_add_drop') ? 'has-error' : '' }}">
                        <label class="col-sm-3 col-form-label"><strong>Add Drop Down Option</strong>
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-3">
                            {!! Form::select('sub_add_drop',['yes' => 'Yes','no' => 'No'],@$pre->sub_add_droup,['class' => 'form-control','id'  => 'add_sub_drop_down','placeholder'   => 'Add Drop-Down Option']) !!}
                            <span class="help-block">
                        <font color="red"> {{ $errors->has('sub_add_drop') ? "".$errors->first('sub_add_drop')."" : '' }} </font>
                    </span>
                        </div>
                        <label class="col-sm-1 col-form-label"><strong>Note</strong><span class="text-danger">*</span></label>
                        <div class="col-sm-2">{!! Form::text('sub_note',null,['class' => 'form-control ','id'    => 'sub_note']) !!}
                            <span class="help-block">
                        <font color="red"> {{ $errors->has('sub_note') ? "".$errors->first('sub_note')."" : '' }} </font>
                    </span>
                        </div>
                        <div class="col-sm-3"><input type="checkbox" name="sub_proceed" value="0" id="sub_proceed"><span class="help-block"><font color="red"> {{ $errors->has('sub_proceed') ? "".$errors->first('sub_proceed')."" : '' }} </font></span><label class="col-sm-6 col-form-label" for="sub_proceed"><strong>Proceed</strong><span class="text-danger">*</span></label></div>
                    </div>
                    <div class="form-group row {{ $errors->has('sub_tooltip') ? 'has-error' : '' }}">
                        <label class="col-sm-3 col-form-label"><strong>Tooltip</strong><span class="text-danger">*</span></label>
                        <div class="col-sm-9">{!! Form::text('sub_tooltip',null,['class' => 'form-control ','id'    => 'sub_tooltip']) !!}<span class="help-block"><font color="red"> {{ $errors->has('sub_tooltip') ? "".$errors->first('sub_tooltip')."" : '' }} </font></span></div>
                    </div>
                </div>


                <div class="hidden ques_ans_block" style="">
                    <hr style="border: 1px dashed #ccc;">
                    <div class="form-group row {{ $errors->has('last_question') ? 'has-error' : '' }}">
                        <label class="col-sm-3 col-form-label">
                            <strong>Question</strong>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            {!! Form::text('last_question',null,[
                            'class' => 'form-control ',
                            'id'    => 'last_question', 'placeholder' => 'Question'
                            ]) !!}
                            <span class="help-block">
                            <font color="red"> {{ $errors->has('last_question') ? "".$errors->first('question')."" : '' }} </font>
                        </span>
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('last_ans_type') ? 'has-error' : '' }}">
                        <label class="col-sm-3 col-form-label">
                            <strong>Answer</strong>
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-9">
                            <select class="form-control" id="last_ans_type" name="last_ans_type">
                                <option selected="selected" value="">Select Answer Type</option>
                                <option value="text">Text</option>
                                <option value="datepicker">Datepicker</option>
                            </select>
                            <span class="help-block">
                            <font color="red"> {{ $errors->has('answer') ? "".$errors->first('answer')."" : '' }} </font>
                        </span>
                        </div>
                    </div>
                </div>

                <div style="cursor:pointer;" class="remove_field btn btn-danger">Remove</div>
            </div>
        </div>
        <br>
        <button style="background-color:green;" class="add_field_button btn btn-info active hidden">Add Sub Question</button>
        <br>
        <br>
    </div>

@endif
<div class="hr-line-dashed"></div>
<div class="col-sm-4">
    <a href="{{route('admin.pre.index')}}" class="btn btn-danger btn-sm">Cancel</a>
    <button class="btn btn-primary btn-sm" type="submit">Save</button>
</div>
@section('styles')
@endsection
@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields = 15; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                //alert('asdas');
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).removeClass('hidden');
                }
                $(this).addClass('hidden');
            });
            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });

        $(wrapper).on("click",".remove_field_id", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('.remove_test').remove(); x--;
        })
    </script>
    <script type="text/javascript">
        function isNumberKey(evt)
        {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }





        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#imagePreview img').on('click',function(){
            $('input[type="file"]').trigger('click');
            $('input[type="file"]').change(function() {
                readURL(this);
            });
        });
    </script>

    <!-- iCheck -->
    <link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('#last_name, #name, #bank_name').on('keyup onmouseout keydown keypress blur change', function (event) {
                var regex = new RegExp("^[a-zA-Z ._\\b]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });

            $('#amount, #contact_number').on('keyup onmouseout keydown keypress blur change', function (e) {
                var key = e.charCode || e.keyCode || 0;
                // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
                // home, end, period, and numpad decimal
                if (($(this).val().length > 15)) {
                    $(this).val('');
                    return false;
                }
                return (
                    key == 8 ||
                    key == 9 ||
                    key == 13 ||
                    key == 46 ||
                    key == 110 ||
                    key == 190 ||
                    (key >= 35 && key <= 40) ||
                    (key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105));
            });
            $('#answer_type').on('change', function () {
                var val = $(this).val();
                if(val === 'drop-down'){
                    $('.dropdownblock').removeClass('hidden');
                }else{
                    if(!$('.dropdownblock').hasClass('hidden')){
                        $('.dropdownblock').addClass('hidden');
                    }
                }
            });

            $('#add_dropdown').on('change', function () {
                var val = $(this).val();
                if(val == 'no'){
                    $('.add_field_button').removeClass('hidden');
                }else{
                    if(!$('.add_field_button').hasClass('hidden')){
                        $('.add_field_button').addClass('hidden');
                    }
                }
            });

            $("#proceed, #sub_proceed").on('click', function () {
                if($(this).is(":checked")){
                    $(this).val('1');
                }else{
                    $(this).val('0');
                }
            });

            $('#sub_answer_type').on('change', function () {
                var val = $(this).val();
                if(val === 'drop-down'){
                    $('.sub_dropdown_block').removeClass('hidden');
                }else{
                    if(!$('.sub_dropdown_block').hasClass('hidden')){
                        $('.sub_dropdown_block').addClass('hidden');
                    }
                }
            });

            $('#add_sub_drop_down').on('change', function () {
                var val = $(this).val();
                if(val == 'no'){
                    $('.ques_ans_block').removeClass('hidden');
                }else{
                    if(!$('.ques_ans_block').hasClass('hidden')){
                        $('.ques_ans_block').addClass('hidden');
                    }
                }
            });
        });

    </script>

@endsection
