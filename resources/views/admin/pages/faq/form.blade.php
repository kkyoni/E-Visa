<div class="container">
    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label ><strong>Select Country</strong></label>
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
                <label ><strong>Select Visa Type</strong></label>
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

        <div class="col-md-6">
            <div class="form-group  row {{ $errors->has('question') ? 'has-error' : '' }}">
                <label class="col-sm-9 col-form-label"><strong>FAQ Question</strong> <span class="text-danger">*</span></label>
                <div class="col-sm-12">{!! Form::text('question',null,[
                    'class' => 'form-control',
                    'id'	=> 'question',
                    'placeholder'=>'Question',
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('question') ? "".$errors->first('question')."" : '' }} </font>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group  row {{ $errors->has('answer') ? 'has-error' : '' }}">
                <label class="col-sm-9 col-form-label"><strong>FAQ Answer</strong> <span class="text-danger">*</span></label>
                <div class="col-sm-12">{!! Form::text('answer',null,[
                    'class' => 'form-control',
                    'id'	=> 'answer',
                    'placeholder'=>'Answer',
                    ]) !!}
                    <span class="help-block">
                        <font color="red"> {{ $errors->has('answer') ? "".$errors->first('answer')."" : '' }} </font>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="col-sm-6">
	<div class="form-group row">
		<div class="col-sm-8 col-sm-offset-8">
			<a href="{{route('admin.faq.index')}}"><button class="btn btn-danger btn-sm" type="button">Cancel</button></a>
			<button class="btn btn-primary btn-sm" type="submit" id="savebtn">Save changes</button>
		</div>
	</div>
</div>

@section('styles')
	<link href="{{ asset('assets/admin/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" type="text/css"/>

<style type="text/css">
	.help-block {
		display: inline-block;
		margin-top: 5px;
		margin-bottom: 0px;
		margin-left: 5px;
	}
	.form-group {
		margin-bottom: 10px;
	}
	.form-control {
		font-size: 14px;
		font-weight: 500;
	}
	#imagePreview{
		width: 100%;
		height: 100%;
		text-align: center;
		margin:0 auto;
	}
	#hidden{
		display: none !important;
	}
	#imagePreview img {
		height: 150px;
		width: 150px;
		border: 3px solid rgba(0,0,0,0.4);
		padding: 3px;
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
		});
	</script>
@endsection
