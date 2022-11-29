@extends('admin.layouts.app')
@section('mainContent')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>User Profile</h2>
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-md-6">
            {!! Form::open([
            'route' => 'admin.updateProfileDetail',
            'files' => true
            ]) !!}
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Profile update</h5>
                </div>

                <div class="ibox-content" id="imagePreview">
                 <!-- <img alt="image" class="rounded-circle" src="{!!  \Auth::user()->avatar !== '' ? url("storage/avatar/".\Auth::user()->avatar) : url('storage/default.png') !!}"  height="70px" width="67px"/> -->
                 @if(!empty(\Auth::user()->avatar))
                    <img src="{!!  url("storage/avatar/".Auth::user()->avatar) !!}" alt="user-img" class="img-circle">
                 @else
                    <img src="{!! url('storage/avatar/default.png') !!}" alt="user-img" class="img-circle" accept="image/*">
                 @endif
            </div>
            {!! Form::file('avatar',['id' => 'hidden','accept'=>"image/*"]) !!}
            <div class="ibox-content profile-content">
                <div class="ibox ">
                    <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-lg-12 col-form-label">Admin Name <span class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <input type="text" placeholder="Name" value="{{$user->name}}" name="name" class="form-control">
                            <span class="help-block">
                                <font color="red"> {{ $errors->has('name') ? "".$errors->first('name')."" : '' }} </font>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="col-lg-12 col-form-label">Email address <span class="text-danger">*</span></label>
                        <div class="col-lg-12">
                            <input type="text" placeholder="Email address"  value="{{$user->email}}" name="email" class="form-control">
                            <span class="help-block">
                                <font color="red"> {{ $errors->has('email') ? "".$errors->first('email')."" : '' }} </font>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary mr-10 mb-30">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-6">
        {!! Form::open([
        'route' => 'admin.updatePassword',
        'files' => true
        ]) !!}

        <div class="ibox">
            <div class="ibox-title">
                <h5>Change Password</h5>
            </div>
            <div class="ibox-content">
                <div class="form-group row {{ $errors->has('old_password') ? 'has-error' : '' }}"><label class="col-lg-4 col-form-label">Current Password <span class="text-danger">*</span></label>

                    <div class="col-lg-8"><input type="password" name="old_password" placeholder="Current Password" class="form-control">
                        <span class="help-blockk">
                            <font color="red"> {{ $errors->has('old_password') ? "".$errors->first('old_password')."" : '' }} </font>
                        </span>
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}"><label class="col-lg-4 col-form-label">New Password <span class="text-danger">*</span></label>

                    <div class="col-lg-8"><input type="password" name="password" placeholder="New Password"  class="form-control">
                        <span class="help-blockk">
                            <font color="red"> {{ $errors->has('password') ? "".$errors->first('password')."" : '' }} </font>
                        </span>
                    </div>

                </div>
                <div class="form-group row {{ $errors->has('password_confirmation') ? 'has-error' : '' }}"><label class="col-lg-4 col-form-label">Confirm Password <span class="text-danger">*</span></label>

                    <div class="col-lg-8"><input type="password"  name="password_confirmation"  placeholder="Confirm Password" class="form-control">
                     <span class="help-blockk">
                        <font color="red"> {{ $errors->has('password_confirmation') ? "".$errors->first('password_confirmation')."" : '' }} </font>
                    </span>

                </div>

            </div>
            <div class="form-group row">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary mr-10 mb-30">Save</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
</div>
@endsection
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
<script type="text/javascript">
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
@endsection
