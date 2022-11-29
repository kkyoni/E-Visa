<div class="form-group  row {{ $errors->has('visa_type') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"><strong>Visa Type</strong> <span class="text-danger">*</span></label>
    <div class="col-sm-6">
        {!! Form::text('visa_type',null,[
        'class' => 'form-control'
        ]) !!}
        <span class="help-block">
			<font color="red"> {{ $errors->has('visa_type') ? "".$errors->first('visa_type')."" : '' }} </font>
		</span>

    </div>
</div>

<div class="form-group row {{ $errors->has('status') ? 'has-error' : '' }}">
    <label class="col-sm-2 col-form-label"><strong>Status</strong></label>
    <div class="col-sm-6 inline-block">
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
			<font color="red"> 	{{ $errors->has('status') ? "".$errors->first('status')."" : '' }} </font>
		</span>
    </div>
</div>
<div class="hr-line-dashed"></div>
<div class="col-sm-4">
    <a href="{{route('admin.visa_types.index')}}" class="btn btn-danger btn-sm" id="close_language">Close</a>
    <button class="btn btn-primary btn-sm" type="submit">Save</button>
</div>


@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- iCheck -->
    <link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });

        $(' #visa_type').on('keyup onmouseout keydown keypress blur change', function (event) {
            var regex = new RegExp("^[a-zA-Z ._\\b\\t]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

    </script>
@endsection
