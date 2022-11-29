@extends('admin.layouts.app')
@section('mainContent')
@if(Session::has('message'))
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-{{ Session::has('alert-type') }}">
            {!! Session::get('message') !!}
        </div>
    </div>
</div>
@endif
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12 color_title">
        <h2> User Management</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.role.index') }}">User Table</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>View User </strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="container">
                        <div class="row wrapper border-bottom white-bg page-heading">
                            <div class="col-lg-12">
                                <form action="">
                                    Back Office Level  {{ Form::select('bank_office_level',$bank_office_level, $bol->id, array('id' => 'some-id','class' => 'form-control','onchange' => 'changeBankOfficeLevel(this)')) }}
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="form-group  row {{ $errors->has('avatar') ? 'has-error' : '' }}">
                            <div id="imagePreview" class="profile-image">
                                @if(!empty($bol->avatar))
                                <img src="{!! @$bol->avatar !== '' ? asset("storage/avatar/".@$bol->avatar) : asset('storage/default.png') !!}" alt="user-img" class="img-circle">
                                @else
                                <img src="{!! asset('storage/avatar/default.png') !!}" alt="user-img" class="img-circle" accept="image/*">
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group  row {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label class="col-sm-4 col-form-label"><strong>Name</strong> <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        {!! Form::text('name',$bol->name,[
                                        'class' => 'form-control',
                                        'id'    => 'name',
                                        'readonly' => 'true'
                                        ]) !!}
                                        <span class="help-block">
                                            <font color="red"> {{ $errors->has('name') ? "".$errors->first('name')."" : '' }} </font>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group  row {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label class="col-sm-4 col-form-label"><strong>Email</strong> <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        {!! Form::text('email',$bol->email,[
                                        'class' => 'form-control',
                                        'id'    => 'email',
                                        'readonly' => 'true'
                                        ]) !!}
                                        <span class="help-block">
                                            <font color="red"> {{ $errors->has('email') ? "".$errors->first('email')."" : '' }} </font>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row {{ $errors->has('mobile') ? 'has-error' : '' }}">
                                    <label class="col-sm-4 col-form-label"><strong>Mobile Number</strong><span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        {!! Form::text('mobile',$bol->mobile,[
                                        'class' => 'form-control',
                                        'id'    => 'mobile',
                                        'maxlength'=>'10',
                                        'readonly' => 'true'
                                        ]) !!}
                                        <span class="help-block">
                                            <font color="red"> {{ $errors->has('mobile') ? "".$errors->first('mobile')."" : '' }} </font>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row {{ $errors->has('wpmobile') ? 'has-error' : '' }}">
                                    <label class="col-sm-4 col-form-label"><strong>Whatsapp Mobile Number</strong><span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        {!! Form::text('wpmobile',$bol->wpmobile,[
                                        'class' => 'form-control',
                                        'id'    => 'wpmobile',
                                        'maxlength'=>'10',
                                        'readonly' => 'true'
                                        ]) !!}
                                        <span class="help-block">
                                            <font color="red"> {{ $errors->has('wpmobile') ? "".$errors->first('wpmobile')."" : '' }} </font>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="role_id" name="role_id" value="{{ $bol->role_id }}">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Module name</th>
                                    <th>List</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($permission as $key=>$permissions)
                                    <tr>
                                        <td>{{$key}}</td>
                                        @foreach($permissions as $perm)
                                        <td>
                                            @if(in_array($perm->name,array_column($user_permission,'name')))
                                            <label class="i-checks">
                                                <input type="checkbox" disabled class="iCheck-helper" checked name="permission[]" value="{{ $perm->id }}"/>
                                            </label>
                                            @else
                                            <label class="i-checks">
                                                <input type="checkbox" disabled class="iCheck-helper" value="{{ $perm->id }}" name="permission[]"/>
                                            </label>
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div class="hr-line-dashed"></div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <div class="col-sm-8 col-sm-offset-8">
                                    <a href="{{route('admin.role.index')}}"><button class="btn btn-danger btn-sm" type="button">Back to List</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    #imagePreview{width: 100%; height: 100%; text-align: center; margin:0 auto;}
    #hidden{display: none !important;}
    #imagePreview img {height: 150px; width: 150px; border: 3px solid rgba(0,0,0,0.4); padding: 3px;}
    #some-id{width: 20%}
    td {border-top: none !important;}
</style>
@section('scripts')
<script>
    function changeBankOfficeLevel(e) {
        var selectedBankOfficeLevel = $('#some-id').children("option:selected").val();
        $('#bank_office_level_id').val(selectedBankOfficeLevel)
        var selectedBankOfficeLevelName = $('#some-id').children("option:selected").text();
        $('#Operator_role').text(selectedBankOfficeLevelName+' Role Permission Table')
        var text = '/admin/role/'+selectedBankOfficeLevel+'/view';
        var url = "{{ url('/') }}"+text;
        window.location.href=url;
    }
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
        $('#bank_office_level_id').val({{ $bol->id }})
    });
</script>
@endsection
@endsection