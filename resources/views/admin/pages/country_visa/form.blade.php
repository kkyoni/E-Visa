<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label ><strong>Select Destination Country</strong></label>
                {!! Form::select('country_id',$country_list,null,[
                    'class' => 'form-control',
                    'id'	=> 'country_id',
                    'required',
                    'placeholder'=>'Select Destination Country'
                ]) !!}
                <span class="help-block">
					<font color="red"> {{ $errors->has('country_id') ? "".$errors->first('country_id')."" : '' }} </font>
				</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label ><strong>Select Visa Type</strong></label>
                {!! Form::select('visa_type_id',$visa_types,null,[
                    'class' => 'form-control',
                    'id'	=> 'visa_type_id',
                    'required',
                    'placeholder'=>'Select Visa Type'
                ]) !!}
                <span class="help-block">
					<font color="red"> {{ $errors->has('visa_type_id') ? "".$errors->first('visa_type_id')."" : '' }} </font>
				</span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label><strong>Select From Country</strong></label>
                {!! Form::select('country_from_id[]',$country_list,@$fromcountry_list,[
                    'class'         => 'select2 form-control',
                    'id'            => 'country_from_id',
                    'multiple'      => 'multiple',
                ]) !!}
                @if($errors->has('country_from_id'))
                    <span class="help-block">
                        {{ $errors->first('country_from_id') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label ><strong>Information</strong></label>
                {!! Form::textarea('information',null,[
                    'class' => 'form-control',
                    'id'	=> 'information',
                    'placeholder'=>'Information',
                    'required',
                    'rows'=>'3'
                ]) !!}
                <span class="help-block">
                        <font color="red"> {{ $errors->has('information') ? "".$errors->first('information')."" : '' }} </font>
                    </span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label ><strong>Required Documents</strong></label>
                {!! Form::textarea('required_docs',null,[
                    'class' => 'form-control',
                    'id'	=> 'required_docs',
                    'placeholder'=>'Required Documents',
                    'required',
                    'rows'=>'3'
                ]) !!}
                <span class="help-block">
                    <font color="red"> {{ $errors->has('required_docs') ? "".$errors->first('required_docs')."" : '' }} </font>
                </span>
            </div>
        </div>

        <?php
            if(sizeof($countryvisafee_list) > 0){
                foreach ($countryvisafee_list as $list){
        ?>

        <div class="clearfix"></div>
        <div class="removeapplicant visafeeedit" style="min-width: 100%;">
            <div class="col-md-4 pull-left">
                <div class="form-group">
                    <label ><strong>Select Visa Type Entry</strong></label>
                    {!! Form::select('visa_type_entry_id[]',$visa_type_entries,@$list->visa_type_entry_id,[
                        'class' => 'form-control',
                        'id'	=> 'visa_type_entry_id',
                        'placeholder'=>'Select Visa Type Entry'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label ><strong>Goverment Fee</strong></label>
                    <input type="text" name="regular_gov_fee[]" class="form-control regular_gov_fee" id=""	placeholder="Goverment Fee" value="{{@$list->regular_gov_fee}}" maxlength="5">
                </div>
            </div>

            <!-- <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label ><strong>Service Type</strong></label>
                    {!! Form::text('regular_service_type[]',@$list->regular_service_type,[
                        'class' => 'form-control',
                        'id'	=> 'regular_service_type',
                        'placeholder'=>'Service Type',
                        'required',
                        'data-role' => 'tagsinput'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('regular_service_type') ? "".$errors->first('regular_service_type')."" : '' }} </font>
                    </span>
                </div>
            </div> -->
            <div class="col-md-2 pull-left">
                <div class="form-group">
                    <label ><strong>Visa Validity</strong></label>
                    {!! Form::text('visa_validity[]',@$list->visa_validity,[
                        'class' => 'form-control',
                        'id'	=> 'visa_validity',
                        'placeholder'=>'Visa Validity',
                        'required',
                        'data-role' => 'tagsinput', 'maxlength'=>'5'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('visa_validity') ? "".$errors->first('visa_validity')."" : '' }} </font>
                    </span>
                </div>
            </div>

            <div class="col-md-2 pull-left">
                <div class="form-group">
                    <label ><strong>Stay Validity</strong></label>
                    {!! Form::text('stay_validity[]',@$list->stay_validity,[
                        'class' => 'form-control',
                        'id'	=> 'stay_validity',
                        'placeholder'=>'Stay Validity',
                        'required',
                        'data-role' => 'tagsinput', 'maxlength'=>'5'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('stay_validity') ? "".$errors->first('stay_validity')."" : '' }} </font>
                    </span>
                </div>
            </div>

            <div class="col-md-2 pull-left">
                <div class="form-group">
                    <label ><strong>Service Fee</strong></label>
                    {!! Form::text('service_fee[]',@$list->service_fee,[
                        'class' => 'form-control',
                        'id'	=> 'service_fee',
                        'placeholder'=>'Service Fee',
                        'required',
                        'data-role' => 'tagsinput', 'maxlength'=>'5'
                    ]) !!}
                    <span class="help-block">
                    <font color="red"> {{ $errors->has('service_fee') ? "".$errors->first('service_fee')."" : '' }} </font>
                </span>
                </div>
            </div>

           
            <!-- update -->

            <div class="col-md-3 pull-left">
            <div class="form-group">
                <label ><strong>Processing Day</strong></label>
                {!! Form::text('processing_day[]',@$list->processing_day,[
                    'class' => 'form-control',
                    'id'    => 'processing_day',
                    'placeholder'=>'Processing Day',
                    'data-role' => 'tagsinput', 'maxlength'=>'5'
                ]) !!}
                <span class="help-block">
                        <font color="red"> {{ $errors->has('processing_day') ? "".$errors->first('processing_day')."" : '' }} </font>
                    </span>
            </div>
        </div>

        
            

            <div class="col-md-2  row">
{{--                <div class="form-group col-md-9">--}}
{{--                    <label ><strong>VAT (TAX)</strong></label>--}}
{{--                    <input type="text" name="vat_tax[]" class="form-control vat_tax"  id=""	placeholder="VAT (TAX)" maxlength="5" value="{{@$list->vat_tax}}">--}}
{{--                </div>--}}
                <div class="form-group col-md-3 pull-right">
                    <div style="margin-top: 2.1em;" class="remove_field btn btn-danger pull-left"><i class="fa fa-close"></i></div>
                </div>
            </div>
            <div class="col-md-12 row">
                <hr class="col-md-12 row">
            </div>
        </div>
        <?php
        }?>
        <div class="col-md-2">
            <div class="form-group">
                <label ><strong></strong></label>
                <button class="btn btn-success add_new" style="margin-top: 2em;">+</button>
            </div>
        </div>
        <?php
            }else{
        ?>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <label ><strong>Select Visa Type Entry</strong></label>
                    {!! Form::select('visa_type_entry_id[]',$visa_type_entries,null,[
                        'class' => 'form-control',
                        'id'	=> '',
                        'placeholder'=>'Select Visa Type Entry'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label ><strong>Goverment Fee</strong></label>
                    <input type="text" name="regular_gov_fee[]" class="form-control regular_gov_fee" id=""	placeholder="Goverment Fee" value="" maxlength="5">
                </div>
            </div>

            <!-- <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label ><strong>Service Type</strong></label>
                    {!! Form::text('regular_service_type[]',null,[
                        'class' => 'form-control',
                        'id'	=> 'regular_service_type',
                        'placeholder'=>'Service Type',
                        'required',
                        'data-role' => 'tagsinput'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('regular_service_type') ? "".$errors->first('regular_service_type')."" : '' }} </font>
                    </span>
                </div>
            </div> -->
            <div class="col-md-2 pull-left">
                <div class="form-group">
                    <label ><strong>Visa Validity</strong></label>
                    {!! Form::text('visa_validity[]',null,[
                        'class' => 'form-control',
                        'id'	=> 'visa_validity',
                        'placeholder'=>'Visa Validity',
                        'required',
                        'data-role' => 'tagsinput', 'maxlength'=>'5'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('visa_validity') ? "".$errors->first('visa_validity')."" : '' }} </font>
                    </span>
                </div>
            </div>

            <div class="col-md-2 pull-left">
                <div class="form-group">
                    <label ><strong>Stay Validity</strong></label>
                    {!! Form::text('stay_validity[]',null,[
                        'class' => 'form-control',
                        'id'	=> 'stay_validity',
                        'placeholder'=>'Stay Validity',
                        'required',
                        'data-role' => 'tagsinput', 'maxlength'=>'5'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('stay_validity') ? "".$errors->first('stay_validity')."" : '' }} </font>
                    </span>
                </div>
            </div>

        <div class="col-md-2 pull-left">
            <div class="form-group">
                <label ><strong>Service Fee</strong></label>
                {!! Form::text('service_fee[]',null,[
                    'class' => 'form-control',
                    'id'	=> 'service_fee',
                    'placeholder'=>'Service Fee',
                    'required',
                    'data-role' => 'tagsinput', 'maxlength'=>'5'
                ]) !!}
                <span class="help-block">
                    <font color="red"> {{ $errors->has('service_fee') ? "".$errors->first('service_fee')."" : '' }} </font>
                </span>
            </div>
        </div>

        <div class="col-md-3 pull-left">
            <div class="form-group">
                <label ><strong>Processing Day</strong></label>
                {!! Form::text('processing_day[]',null,[
                    'class' => 'form-control',
                    'id'	=> 'processing_day',
                    'placeholder'=>'Processing Day',
                    'data-role' => 'tagsinput', 'maxlength'=>'5'
                ]) !!}
                <span class="help-block">
                        <font color="red"> {{ $errors->has('processing_day') ? "".$errors->first('processing_day')."" : '' }} </font>
                    </span>
            </div>
        </div>

        
        <!-- Crete -->
            <div class="col-md-2 pull-left row">
{{--                <div class="form-group col-md-9">--}}
{{--                    <label ><strong>VAT (TAX)</strong></label>--}}
{{--                    <input type="text" name="vat_tax[]" class="form-control express_gov_fee"  id=""	placeholder="VAT (TAX)" maxlength="5">--}}
{{--                </div>--}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label ><strong></strong></label>
                        <button class="btn btn-success add_new" style="margin-top: 2em;">+</button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="newfields" style="min-width: 100%;"></div>

{{--        <div class="col-md-12">--}}
{{--            <div class="form-group">--}}
{{--                <label ><strong></strong></label>--}}
{{--                <button class="btn btn-success add_new" style="margin-top: 25px;">+</button>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="getallfields hidden">
            <div class="col-md-12 row">
                <hr class="col-md-12 row">
            </div>
            <div class="col-md-4 pull-left">
                <div class="form-group">
                    <label ><strong>Select Visa Type Entry</strong></label>
                    {!! Form::select('visa_type_entry_id[]',$visa_type_entries,null,[
                        'class' => 'form-control',
                        'id'	=> '',
                        'placeholder'=>'Select Visa Type Entry'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label ><strong>Goverment Fee</strong></label>
                    <input type="text" name="regular_gov_fee[]" class="form-control regular_gov_fee" id=""	placeholder="Goverment Fee" value="" maxlength="5">
                </div>
            </div>

            <!-- <div class="col-md-3 pull-left">
                <div class="form-group">
                    <label ><strong>Service Type</strong></label>
                    {!! Form::text('regular_service_type[]',null,[
                        'class' => 'form-control',
                        'id'	=> 'regular_service_type',
                        'placeholder'=>'Service Type',
                        'data-role' => 'tagsinput'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('regular_service_type') ? "".$errors->first('regular_service_type')."" : '' }} </font>
                    </span>
                </div>
            </div> -->
            <div class="col-md-2 pull-left">
                <div class="form-group">
                    <label ><strong>Visa Validity</strong></label>
                    {!! Form::text('visa_validity[]',null,[
                        'class' => 'form-control',
                        'id'	=> 'visa_validity',
                        'placeholder'=>'Visa Validity',

                        'data-role' => 'tagsinput', 'maxlength'=>'5'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('visa_validity') ? "".$errors->first('visa_validity')."" : '' }} </font>
                    </span>
                </div>
            </div>

            <div class="col-md-2 pull-left">
                <div class="form-group">
                    <label ><strong>Stay Validity</strong></label>
                    {!! Form::text('stay_validity[]',null,[
                        'class' => 'form-control',
                        'id'	=> 'stay_validity',
                        'placeholder'=>'Stay Validity',
                        'data-role' => 'tagsinput', 'maxlength'=>'5'
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('stay_validity') ? "".$errors->first('stay_validity')."" : '' }} </font>
                    </span>
                </div>
            </div>

            <div class="col-md-2 pull-left">
                <div class="form-group">
                    <label ><strong>Service Fee</strong></label>
                    {!! Form::text('service_fee[]',null,[
                        'class' => 'form-control',
                        'id'	=> 'service_fee',
                        'placeholder'=>'Service Fee',
                        'data-role' => 'tagsinput', 'maxlength'=>'5'
                    ]) !!}
                    <span class="help-block">
                    <font color="red"> {{ $errors->has('service_fee') ? "".$errors->first('service_fee')."" : '' }} </font>
                </span>
                </div>
            </div>

            

            <div class="col-md-3 pull-left">
            <div class="form-group">
                <label ><strong>Processing Day</strong></label>
                {!! Form::text('processing_day[]',null,[
                    'class' => 'form-control',
                    'id'    => 'processing_day',
                    'placeholder'=>'Processing Day',
                    'data-role' => 'tagsinput', 'maxlength'=>'5'
                ]) !!}
                <span class="help-block">
                        <font color="red"> {{ $errors->has('processing_day') ? "".$errors->first('processing_day')."" : '' }} </font>
                    </span>
            </div>
        </div>

        

            


            <div class="col-md-2 pull-left row">
{{--                <div class="form-group col-md-9">--}}
{{--                    <label ><strong>VAT (TAX)</strong></label>--}}
{{--                    <input type="text" name="vat_tax[]" class="form-control express_gov_fee"  id=""	placeholder="VAT (TAX)" maxlength="5">--}}
{{--                </div>--}}
                <div class="form-group col-md-3 pull-right">
                    <div style="margin-top: 2.1em;" class="remove_field btn btn-danger pull-left"><i class="fa fa-close"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-12 row">
            <div class="form-group col-md-6">
                <label class="col-sm-4 col-form-label"><strong>Status</strong></label>
                <div class="i-checks">
                    <label>
                        {{ Form::radio('status', 'active' ,true,['id'=> 'active']) }} <i></i> Active
                    </label>
                    <label>
                        {{ Form::radio('status', 'inactive' ,false,['id' => 'inactive']) }}
                        <i></i> InActive
                    </label>
                </div>
                <span class="help-block">
					<font color="red"> {{ $errors->has('status') ? "".$errors->first('status')."" : '' }} </font>
				</span>
            </div>

{{--            <div class="form-group col-md-6">--}}
{{--                <div class="form-group">--}}
{{--                    <label ><strong>Processing Days</strong></label>--}}
{{--                    {!! Form::text('processing_days',null,[--}}
{{--                        'class' => 'form-control',--}}
{{--                        'id'	=> 'processing_days',--}}
{{--                        'placeholder'=>'Visa Validity',--}}
{{--                        'data-role' => 'tagsinput'--}}
{{--                    ]) !!}--}}
{{--                    <span class="help-block">--}}
{{--                        <font color="red"> {{ $errors->has('processing_days') ? "".$errors->first('processing_days')."" : '' }} </font>--}}
{{--                    </span>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="col-sm-4">
    <a href="{{route('admin.country_visa.index')}}" class="btn btn-danger btn-sm" id="close_language">Close</a>
    <button class="btn btn-primary btn-sm" type="submit">Save</button>
</div>
@section('styles')
<link href="{{ asset('assets/admin/css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">
<link href="{{ asset('assets/admin/css/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/tagging.css') }}">
    <style>
        .select2-container--default{width: 455px !important;}
        .select2-search__field{width: auto !important;}
        .tagging {
            border: 1px solid #CCCCCC;
            cursor: text;
            font-size: 1em;
            height: auto;
            padding: 0.75rem 1rem;
            line-height: 1.25;
            display: block;
        }
        .tagging .tag {
            background: none repeat scroll 0 0 #EE7407;
            border-radius: 2px;
            color: white;
            cursor: default;
            display: inline-block;
            position: relative;
            white-space: nowrap;
            padding: 5px 25px 6px 0px;
            margin: 3px;
        }

        /*added css for certificate not clickable */
        select[readonly].select2 + .select2-container {
            pointer-events: none;
            touch-action: none;
        }
        .select2-selection {
            background: #eee;
            box-shadow: none;
        }

        .select2-selection__arrow,
        .select2-selection__clear {
            display: none;
        }
    </style>
@endsection
@section('scripts')
    <!-- iCheck -->
    <link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            var x = 1;
            var max_fields = 30;
            $('.add_new').on('click', function (e) {
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    var ss = x++;
                    $('.newfields').append('<div class="removeapplicant remove_test" >' +$(".getallfields").html()+'</div>');
                }
            });
            $('.newfields').on("click",".remove_field", function(e){
                e.preventDefault(); $(this).parents('.removeapplicant').remove(); x--;
            });

            $('.visafeeedit').on("click",".remove_field", function(e){
                e.preventDefault(); $(this).parents('.removeapplicant').remove(); x--;
            })

            $('#visa_validity, #stay_validity, #regular_service_cost, #express_service_cost, .regular_gov_fee, .express_gov_fee').on('keyup onmouseout keydown keypress blur change', function (event) {
                var regex = new RegExp("^[0-9 ._\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
    <!-- <script src="{{ asset('assets/admin/js/jquery-3.1.1.min.js') }}"></script> -->
    <script src="{{ asset('assets/admin/js/plugins/clockpicker/clockpicker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/tagging.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/prism.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('#country_from_id').select2({
            closeOnSelect: false,
            placeholder: "Select From Country",
            allowClear: true,
            tags: true,
            tokenSeparators: [','],
            search: true
        });
    </script>
    <script>
$(document).ready(function(){
    // alert("in");
    $('.clockpicker').clockpicker();
});
</script>
@endsection
