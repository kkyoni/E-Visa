<div class="form-group  row {{ $errors->has('name') ? 'has-error' : '' }}">
    <div id="imagePreview" class="profile-image">
        @if(!empty($users->avatar))
        <img src="{!! @$users->avatar !== '' ? url("storage/avatar/".@$users->avatar) : url('storage/default.png') !!}" alt="user-img" class="img-circle">
        @else
        <img src="{!! url('storage/avatar/default.png') !!}" alt="user-img" class="img-circle" accept="image/*">
        @endif
    </div>
    {!! Form::file('avatar',['id' => 'hidden','accept'=>"image/*"]) !!}
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group  row {{ $errors->has('name') ? 'has-error' : '' }}">
            <label class="col-sm-4 col-form-label"><strong>Name</strong> <span class="text-danger">*</span></label>
            <div class="col-sm-8">{!! Form::text('name',$users->name,[
              'class' => 'form-control',
              'id'	=> 'name'
              ]) !!}
              <span class="help-block">
               <font color="red"> {{ $errors->has('name') ? "".$errors->first('name')."" : '' }} </font>
           </span>
       </div>
   </div>
   <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
    <label class="col-sm-4 col-form-label"><strong>Email address</strong> <span class="text-danger">*</span></label>
    <div class="col-sm-8">{!! Form::text('email',$users->email,[
      'class' => 'form-control',
      'id'	=> 'email'
      ]) !!}
      <span class="help-block">
       <font color="red"> {{ $errors->has('email') ? "".$errors->first('email')."" : '' }} </font>
   </span>
</div>
</div>
<div class="form-group row {{ $errors->has('mobile') ? 'has-error' : '' }}">
    <label class="col-sm-4 col-form-label">
        <strong>Mobile Number</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-8">{!! Form::text('mobile',$users->mobile,[
      'class' => 'form-control',
      'id'	=> 'mobile', 'maxlength'=>'10'
      ]) !!}
      <span class="help-block">
       <font color="red"> {{ $errors->has('mobile') ? "".$errors->first('mobile')."" : '' }} </font>
   </span>
</div>
</div>
<div class="form-group row {{ $errors->has('passport') ? 'has-error' : '' }}">
    <label class="col-sm-4 col-form-label">
        <strong>Passport Number</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-8">{!! Form::text('passport',$users->passport,[
      'class' => 'form-control',
      'id'	=> 'passport'
      ]) !!}
      <span class="help-block">
       <font color="red"> {{ $errors->has('passport') ? "".$errors->first('passport')."" : '' }} </font>
   </span>
</div>
</div>
<div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}">
    <label class="col-sm-4 col-form-label"><strong>Password</strong> <span class="text-danger">*</span></label>
    <div class="col-sm-8">
        {!! Form::password('password',[
        'class' => 'form-control',
        'id'	=> 'password'
        ]) !!}
        <span class="help-block">
           <font color="red"> {{$errors->has('password') ? "".$errors->first('password')."" : '' }} </font>
       </span>
   </div>
</div>
<div class="form-group row {{ $errors->has('wpmobile') ? 'has-error' : '' }}">
    <label class="col-sm-4 col-form-label">
        <strong>Whatsapp Mobile Number</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-8">{!! Form::text('wpmobile',$users->wpmobile,[
      'class' => 'form-control',
      'id'	=> 'wpmobile', 'maxlength'=>'10'
      ]) !!}
      <span class="help-block">
       <font color="red"> {{ $errors->has('wpmobile') ? "".$errors->first('wpmobile')."" : '' }} </font>
   </span>
</div>
</div>
</div>
<div class="col-lg-6">
    <div class="form-group row {{ $errors->has('passport_issue_date') ? 'has-error' : '' }}">
        <label class="col-sm-4 col-form-label">
            <strong>Passport issue Date</strong>
            <span class="text-danger">*</span>
        </label>
        <div class="col-sm-8">
            {!! Form::text('passport_issue_date', $users->passport_issue_date, array('id' => 'passport_issue_date','class' => 'form-control')) !!}
            <span class="help-block">
               <font color="red"> {{ $errors->has('passport_issue_date') ? "".$errors->first('passport_issue_date')."" : '' }} </font>
           </span>
       </div>
   </div>
   <div class="form-group row {{ $errors->has('passport_expiry_date') ? 'has-error' : '' }}">
    <label class="col-sm-4 col-form-label">
        <strong>Passport Expiry Date</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-8">
        {!! Form::text('passport_expiry_date', $users->passport_expiry_date, array('id' => 'passport_expiry_date','class' => 'form-control')) !!}
        <span class="help-block">
           <font color="red"> {{ $errors->has('passport_expiry_date') ? "".$errors->first('passport_expiry_date')."" : '' }} </font>
       </span>
   </div>
</div>
<div class="form-group row {{ $errors->has('referral_code') ? 'has-error' : '' }}">
    <label class="col-sm-4 col-form-label">
        <strong>Referral Code</strong>
        <span class="text-danger">*</span>
    </label>
    <div class="col-sm-8">
        {!! Form::text('referral_code',$users->unique_id,[
        'class' => 'form-control',
        'id'	=> 'referral_code',
        'readonly'
        ]) !!}
        <span class="help-block">
           <font color="red"> {{ $errors->has('referral_code') ? "".$errors->first('referral_code')."" : '' }} </font>
       </span>
   </div>
</div>
<div class="formform-group row {{ $errors->has('status') ? 'has-error' : '' }}">
    <label class="col-sm-4 col-form-label"><strong>Status</strong></label>
    <div class="col-sm-8 inline-block">
        <div class="i-checks">
            <label>
                {{ Form::radio('status', 'block' ,['id'=> 'inactive']) }} <i></i> Block
            </label>
        </div>
        <div class="i-checks">
            <label>
                {{ Form::radio('status', 'active' ,['id' => 'active']) }}
                <i></i> Active
            </label>
        </div>

        <span class="help-block">
           <font color="red"> 	{{ $errors->has('status') ? "".$errors->first('status')."" : '' }} </font>
       </span>
   </div>
</div>
</div>
</div>
<div class="hr-line-dashed"></div>

<div class="col-sm-6">
    <div class="form-group row">
        <div class="col-sm-8 col-sm-offset-8">
            <a href="{{route('admin.index')}}"><button class="btn btn-danger btn-sm" type="button">Cancel</button></a>
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
<!-- iCheck -->
<link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">
<script type="text/javascript">
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });
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


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function () {
        $( "#passport_expiry_date" ).datepicker({
            changeMonth: true,
            changeYear: true
        });
        $( "#passport_issue_date" ).datepicker({
            changeMonth: true,
            changeYear: true
        });

        $('#name').on('keyup onmouseout keydown keypress blur change', function (event) {
            var regex = new RegExp("^[a-zA-Z ._\\b\\t]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        });

        $('#mobile, #wpmobile').on('keyup onmouseout keydown keypress blur change', function (event) {
            var regex = new RegExp("^[0-9 ._\\b\\t]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }

        });
    });
</script>
@endsection
