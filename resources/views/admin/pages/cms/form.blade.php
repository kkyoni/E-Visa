{!! Form::hidden('slug',null,[
'class' => 'form-control',
'disabled' => 'disabled',
'id'	=> 'slug'
]) !!}
<div class="form-group  row {{ $errors->has('title') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Title</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-6">
        {!! Form::text('title',null,[
        'class' => 'form-control',
        'id'	=> 'title'
        ]) !!}
        <span class="help-block">
			<font color="red"> {{ $errors->has('title') ? "".$errors->first('title')."" : '' }} </font>
		</span>
    </div>
</div>
<div class="form-group row {{ $errors->has('description') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Description</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-9">{!! Form::textarea('description',null,[
		'class' => 'form-control ',
		'id'	=> 'description'
		]) !!}
        <span class="help-block">
			<font color="red"> {{ $errors->has('description') ? "".$errors->first('description')."" : '' }} </font>
		</span>
    </div>
</div>
<div class="form-group row {{ $errors->has('status') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label">
        <strong>Status</strong>
    </label>
    &nbsp;&nbsp;
    <div class="col-sm-6 inline-block">
        <div class="i-checks">
            <label>
                {{ Form::radio('status', 'active' ,['id' => 'active']) }}
                <i></i> Active
            </label>
        </div>
        <div class="i-checks">
            <label>
                {{ Form::radio('status', 'block' ,['id'=> 'block']) }} <i></i> Block
            </label>
        </div>
        <span class="help-block">
			<font color="red"> 	{{ $errors->has('status') ? "".$errors->first('status')."" : '' }} </font>
		</span>
    </div>
</div>

<div class="hr-line-dashed"></div>
<div class="col-sm-6">
    <div class="form-group row">
        <div class="col-sm-8 col-sm-offset-8">
            <a href="{{route('admin.cms.index')}}"><button class="btn btn-danger btn-sm" type="button">Cancel</button></a>
            <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
        </div>
    </div>
</div>

@section('styles')
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
    <link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            $('#page_title').on('keyup onmouseout keydown keypress blur change', function (event) {
                var regex = new RegExp("^[a-zA-Z ._\\b]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        var editor = CKEDITOR.replace( 'description', {
            language: 'en',
            toolbar :
                [
                    { name: 'document', items : [ 'NewPage','Preview' ] },
                    { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                    { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
                    { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'
                            ,'Iframe' ] },
                    '/',
                    { name: 'styles', items : [ 'Styles','Format' ] },
                    { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                    { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
                    { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                    { name: 'tools', items : [ 'Maximize','-','About' ] }
                ],
            extraPlugins: 'notification'
        });

        editor.on( 'required', function( evt ) {
            editor.showNotification( 'This field is required.', 'warning' );
            evt.cancel();
        } );

    </script>
@endsection
