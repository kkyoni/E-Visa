<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label ><strong>Country</strong></label>
                {!! Form::select('country_id',$country_list,null,[
                    'class' => 'form-control',
                    'id'	=> 'country_id',
                    'placeholder'=>'Select Country'
                ]) !!}
                <span class="help-block">
					<font color="red"> {{ $errors->has('country_id') ? "".$errors->first('country_id')."" : '' }} </font>
				</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label ><strong>Visa Type</strong></label>
                {!! Form::select('visa_type_id',$visa_types,null,[
                    'class' => 'form-control',
                    'id'	=> 'visa_type_id',
                    'placeholder'=>'Select Visa Type'
                ]) !!}
                <span class="help-block">
					<font color="red"> {{ $errors->has('visa_type_id') ? "".$errors->first('visa_type_id')."" : '' }} </font>
				</span>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-md-6">
            <div class="form-group">
                <label ><strong>Amount</strong></label>
                {!! Form::text('amount',null,[
                    'class' => 'form-control',
                    'id'	=> 'amount',
                    'placeholder'=>'Amount',
                    'data-role' => 'tagsinput', 'maxlength'=>'4'
                ]) !!}
                <span class="help-block">
					<font color="red"> {{ $errors->has('amount') ? "".$errors->first('amount')."" : '' }} </font>
				</span>
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label ><strong>Status</strong></label>
                @php($status = array('pickup'=>'Pickup','drop-off'=>'Drop-Off'))
                {!! Form::select('status',$status,@$prices->status,[
                    'class' => 'form-control',
                    'id'	=> 'status',
                    'placeholder'=>'Select Status'
                ]) !!}
                <span class="help-block">
					<font color="red"> {{ $errors->has('status') ? "".$errors->first('status')."" : '' }} </font>
				</span>
            </div>
        </div>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="col-sm-4">
    <a href="{{route('admin.prices.index')}}" class="btn btn-danger btn-sm">Cancel</a>
    <button class="btn btn-primary btn-sm" type="submit">Save</button>
</div>
@section('scripts')
    <!-- iCheck -->
    <link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('#amount').on('keyup onmouseout keydown keypress blur change', function (e) {
                var regex = new RegExp("^[0-9 ._\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    return false;
                }
            });
        });
    </script>

@endsection
