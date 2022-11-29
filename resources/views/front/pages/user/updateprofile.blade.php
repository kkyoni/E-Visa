@extends('front.layouts.app')
@section('title', 'My Account')
@section('mainContent')


    <body>
    <div class="mid-start">
        <!-- My Account start -->
        <div class="container">
            <div class="my-account">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#basic-info" role="tab" aria-controls="basic-info">Personal Infomation <img src="{{asset('images/plane-right-red.png') }}" alt=""></a>
                    </li>
                    @if($user->social_status == "web")
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#additional-info" role="tab" aria-controls="additional-info">Change Password <img src="{{asset('images/plane-right-red.png') }}" alt=""></a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#notification-setting" role="tab" aria-controls="notification-setting">Setting <img src="{{asset('images/plane-right-red.png') }}" alt=""></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('front.logout') }}" class="nav-link">Logout</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <!-- Basic Information start -->
                    <div class="tab-pane basic-info active impo-instruction" id="basic-info" role="tabpanel">
                        <form method="POST" action="{{ route('updateProfileDetail')}}" enctype="multipart/form-data" id="form-comment" class="form-validate">
                            @csrf
                            <div class="basic-details ">
                                <div class="bd-title">Update your basic details</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" placeholder="Enter Name">
                                                    @if($errors->has('name'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('name')  }}</strong>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" name="email" class="form-control" value="{{$user->email}}" placeholder="Enter Email">
                                                    @if($errors->has('email'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('email')  }}</strong>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="edit-profile">
                                            <div class="profile-upload">
                                                <div class="circle upload-button">
                                                    @if(!empty($user->avatar))
                                                        <img class="profile-pic user_profile" src="{!! @$user->avatar !== '' ? asset("storage/avatar/".@$user->avatar) : asset('storage/default.png') !!}" alt="user-img" >
                                                    @else
                                                        <img class="profile-pic user_profile" src="{!! asset('storage/avatar/default.png') !!}" alt="user-img" accept="image/*" >
                                                    @endif
                                                </div>
                                                <div class="p-image ">
                                                    {!! Form::file('avatar',['class' => 'file-upload form-control','id' => 'hidden','accept'=>"image/*"]) !!}
                                                    {{--                                                <input class="file-upload" type="file" accept="image/*"/>--}}
                                                </div>
                                            </div>
                                            <div class="ep-title">Edit Profile Image</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Mobile number</label>
                                            <input type="text" name="mobile" class="form-control mobile" value="{{$user->mobile}}" placeholder="Enter Number" maxlength="10">
                                            @if($errors->has('mobile'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('mobile')  }}</strong>
                                                    </div>
                                                    @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Whatsapp number</label>
                                            <input type="text" name="wpmobile" class="form-control wpmobile" value="{{$user->wpmobile}}" placeholder="Whatsapp Number" maxlength="10">
                                            @if($errors->has('wpmobile'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('wpmobile')  }}</strong>
                                                    </div>
                                                    @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="bd-title pd-title">Update your passport details</div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Passport number</label>
                                            <input type="text" name="passport" class="form-control" value="{{$user->passport}}" placeholder="Enter Passport">
                                            @if($errors->has('passport'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('passport')  }}</strong>
                                                    </div>
                                                    @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Passport issue date</label>
                                            <input type="date" id="birthday" name="passport_issue_date" value="{{$user->passport_issue_date}}" class="form-control" max="{{date('Y-m-d')}}">
                                            @if($errors->has('passport_issue_date'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('passport_issue_date')  }}</strong>
                                                    </div>
                                                    @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Passport expiration date</label>
                                            <input type="date" id="birthday" name="passport_expiry_date" value="{{$user->passport_expiry_date}}" class="form-control" min="{{date('Y-m-d')}}">
                                            @if($errors->has('passport_expiry_date'))
                                                    <div class="help-block">
                                                        <strong>{{ $errors->first('passport_expiry_date')  }}</strong>
                                                    </div>
                                                    @endif
                                        </div>
                                    </div>

                                    <div class="upload-doc">
                                        <div class="col-md-12">
                                            <div class="sec-title">Upload <span class="color-red">Documents</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if(!empty($user->passport_photo))
                                                        <img class="profile-pic" src="{!! @$user->passport_photo !== '' ? asset("storage/avatar/".@$user->passport_photo) : asset('storage/default.png') !!}" alt="user-img" >
                                                    @else
                                                        <img class="profile-pic" src="{!! asset('storage/avatar/default.png') !!}" alt="user-img" accept="image/*" >
                                                    @endif
                                                    <div class="form-group">
                                                        <label>Upload Passport</label>
                                                        <input type="file" name="passport_photo" id="upload-id" class="inputfile inputfile-1 form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @if(!empty($user->user_photo))
                                                        <img class="profile-pic" src="{!! @$user->user_photo !== '' ? asset("storage/avatar/".@$user->user_photo) : asset('storage/default.png') !!}" alt="user-img" >
                                                    @else
                                                        <img class="profile-pic" src="{!! asset('storage/avatar/default.png') !!}" alt="user-img" accept="image/*" >
                                                    @endif
                                                    <div class="form-group">
                                                        <label>Upload Photo</label>
                                                        <input type="file" name="user_photo" id="upload-id1" class="inputfile inputfile-1 form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="impo-instruction">
                                            <div class="impo-instruction-title">Important Instructions</div>
                                            <div class="impo-instruction-text">
                                                Cheesy feet camembert de normandie danish fontina. Caerphilly pecorino when the cheese comes out everybody's happy pecorino pepper jack pepper jack airedale swiss. Chalk and cheese queso mascarpone edam croque monsieur camembert de normandie rubber cheese camembert de normandie. Macaroni cheese paneer queso cheese on toast cheesecake stilton.
                                            </div><br>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 basic-details-btn">
                                        <button class="arrow-btn bon">
                                            <span class="ab-text">Update </span>
                                            <img src="{{asset('images/right-arrow-white.png') }}" alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Basic Information end -->

                    <!-- Additional Information start -->
                    <div class="tab-pane impo-instruction" id="additional-info" role="tabpanel">
                        <form method="POST" action="{{route('updatePassword')}}" id="form-comments" class="form-validate">
                            @csrf
                            <div class="basic-details">
                                <div class="bd-title">Change password</div>
                                <div class="row">
                                    <div class="col-lg-7 col-xl-6">
                                        <div class="form-group">
                                            <label>Current password</label>
                                            <input type="password" class="form-control" name="old_password" placeholder="Current password*" id="pass_log_id">
                                        </div>
                                        <div class="form-group">
                                            <label>New password</label>
                                            <input type="password" name="password" class="form-control" id="npass_log_id" placeholder="New Password*">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm password</label>
                                            <input type="password" name="password_confirmation"  class="form-control" id="cpass_log_id" placeholder="Confirm new password*">
                                        </div>
                                        <div class="basic-details-btn">
                                            <button class="arrow-btn">
                                                <span class="ab-text">Update </span>
                                                <img src="{{asset('images/right-arrow-white.png') }}" alt="">
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Additional Information end -->
                    <div class="tab-pane impo-instruction" id="notification-setting" role="tabpanel">

                        <div class="basic-details">
                            <div class="bd-title">Enable or Disable email notification for</div>
                            <form method="POST" action="{{route('notification_setting')}}" id="form-comments" class="form-validate">
                                @csrf
                                @if(!empty($notification))
                                    <div class="row">
                                        <div class="col-lg-7 col-xl-6">
                                            <div class="form-group swithch-btn">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1" @if($notification->passport_expiry == "active") checked @else @endif>
                                                    <label class="custom-control-label" for="customSwitch1">Passport expiry</label>
                                                    <input type="hidden" name="passport_expiry" value="@if($notification->passport_expiry == "active") active @else block @endif" id="Switch1">
                                                </div>
                                            </div>
                                            <div class="form-group swithch-btn">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch2" @if($notification->profile_image_update == "active") checked @else @endif>
                                                    <label class="custom-control-label" for="customSwitch2">Profile image update</label>
                                                    <input type="hidden" name="profile_image_update" value="@if($notification->profile_image_update == "active") active @else block @endif" id="Switch2">
                                                </div>
                                            </div>
                                            <div class="form-group swithch-btn">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch3" @if($notification->visa_statua_update == "active") checked @else @endif>
                                                    <label class="custom-control-label" for="customSwitch3">Visa status update</label>
                                                    <input type="hidden" name="visa_statua_update" value="@if($notification->visa_statua_update == "active") active @else block @endif" id="Switch3">
                                                </div>
                                            </div>
                                            <div class="basic-details-btn">
                                                <button class="arrow-btn bon">
                                                    <span class="ab-text">Update </span>
                                                    <img src="{{asset('images/right-arrow-white.png') }}" alt="">
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-7 col-xl-6">
                                            <div class="form-group swithch-btn">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                                    <label class="custom-control-label" for="customSwitch1">Passport expiry</label>
                                                    <input type="hidden" name="passport_expiry" value="block" id="Switch1">
                                                </div>
                                            </div>
                                            <div class="form-group swithch-btn">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                                    <label class="custom-control-label" for="customSwitch2">Profile image update</label>
                                                    <input type="hidden" name="profile_image_update" value="block" id="Switch2">
                                                </div>
                                            </div>
                                            <div class="form-group swithch-btn">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                                    <label class="custom-control-label" for="customSwitch3">Visa status update</label>
                                                    <input type="hidden" name="visa_statua_update" value="block" id="Switch3">
                                                </div>
                                            </div>
                                            <div class="basic-details-btn">
                                                <button class="arrow-btn">
                                                    <span class="ab-text">Update </span>
                                                    <img src="{{asset('images/right-arrow-white.png') }}" alt="">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account start -->
    </div>

    <style>
        .profile-pic{ max-width: 200px; }
        .help-block { color: red;}
    </style>



    <!-- profile image upload -->
    <script>
        $(document).ready(function() {
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('.user_profile').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function(){
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
   
        $("#customSwitch1").change(function(){
            if($(this).prop("checked") == true){
                $("#Switch1").val("active");
            }else{
                $("#Switch1").val("block");
            }
        });

        $("#customSwitch2").change(function(){
            if($(this).prop("checked") == true){
                $("#Switch2").val("active");
            }else{
                $("#Switch2").val("block");
            }
        });

        $("#customSwitch3").change(function(){
            if($(this).prop("checked") == true){
                $("#Switch3").val("active");
            }else{
                $("#Switch3").val("block");
            }
        });

        $(document).ready(function(){
            $(document).on("change",".inputfile",function(e){
                var fileName = '';
                var label    = $(this).next();
                labelVal = label.html();
                if( this.files && this.files.length > 1 )
                    fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                else
                    fileName = e.target.value.split( '\\' ).pop();
                if( fileName )
                    label.find("span").html(fileName);
                else
                    label.html(labelVal);
            })

            $('.wpmobile, .mobile').on('keyup onmouseout keydown keypress blur change', function (e) {
                var regex = new RegExp("^[0-9 ._\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    return false;
                }
            });

        });
    </script>
@endsection
