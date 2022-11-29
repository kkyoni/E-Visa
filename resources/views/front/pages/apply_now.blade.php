@extends('front.layouts.app')
@section('title', 'No Visa')
@section('mainContent')
    <div class="mid-start">
    {!!
        Form::open([
        'route' => ['front.applynowform'],
        'id'    => 'applynowform',
        'files' => 'true'
        ])
    !!}
    <!-- general and application start -->
        <div class="container">
            <div class="personal-info">
                <div class="general-info-top">
                    <div class="sec-title">General <span class="color-red">Information</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                    <a href="#" class="arrow-btn yellow-bodr"><span class="ab-text">Video explainer</span></a>
                </div>

                <div class="personal-info-form">
                    <div class="row">
                        <div class="col-md-12 col-lg-10">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        @if(\Auth::check())
                                            <input type="text" class="form-control" name="email" value="{{ @$user->email  }}" required>
                                        @else
                                            <input type="text" class="form-control" name="email" value="" required placeholder="Email Id">
                                        @endif

                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Whatsapp Number</label>
                                        <input type="text" class="form-control" name="whatapp_number" value="{{ @$user->wpmobile  }}" placeholder="Whatsapp Number" required maxlength="10">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Arrival Date in the selected country</label>
                                        <div class='input-group date' id='arrival_datetimepicker'>
                                            <input type='text' class="form-control arrival_date" id="arrival_date" name="arrival_date" required placeholder="Arrival Date"  />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Departure Date in the selected country</label>
                                        <div class='input-group date' id='depature_datetimepicker'>
                                            <input type='text' class="form-control departure_date" id="departure_date" name="departure_date" required placeholder="Departure Date" />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sec-title mt-4">Applicant’s Information <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                    <div class="appli-info">
                        <div class="appli-info-title">#Applicant 1 <span>(Do fill all the information as in passport)</span></div>
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>First and Middle Name</label>
                                    <input type="text" class="form-control first_name" placeholder="First and Middle Name" required name="first_name[]">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control last_name" placeholder="Last Name" name="last_name[]" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control custom-select " name="gender[]" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Nationality</label>
                                    <!-- <select class="form-control" name="nationality[]" required tabindex="-1" aria-hidden="true">
                                        <option value="">Please Select</option>
                                        @if(sizeof($countries) > 0)
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->country}}</option>
                                            @endforeach
                                        @endif
                                    </select> -->
                                    {!! Form::select('nationality[]',$nationality_countries,@$nationality_id,[
                                        'class' => 'form-control',
                                        'id'    => 'visa_type_entry_id',
                                        'placeholder'=>'Select Nationality'
                                        ]) !!}
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <div class='input-group date birthdate' id='birthdate'>
                                        <input type='text' class="form-control birthdate"  name="birthdate[]" required placeholder="Birth Date" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Country of Birth</label>
                                    <select class="form-control" name="birth_country[]" required tabindex="-1" aria-hidden="true">
                                        <option value="">Please Select</option>
                                        @if(sizeof($countries) > 0)
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->country}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Country of Residence</label>
                                    <!-- <select class="form-control" name="resident_country[]" required tabindex="-1" aria-hidden="true">
                                        <option value="">Please Select</option>
                                        @if(sizeof($countries) > 0)
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->country}}</option>
                                            @endforeach
                                        @endif
                                    </select> -->
                                    {!! Form::select('resident_country[]',$nationality_countries,@$country_residence,[
                                        'class' => 'form-control',
                                        'id'    => 'visa_type_entry_id',
                                        'placeholder'=>'Country of Residence'
                                        ]) !!}
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Passport Number</label>
                                    <input type="text" class="form-control" name="passport_number[]" placeholder="Passport Number" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Passport Issue Date</label>
                                    <div class='input-group date passport_issue_date' id='passport_issue_date'>
                                        <input type='text' class="form-control passport_issue_date" name="passport_issue_date[]" required placeholder="Passport Issue Date"  />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Passport Expiration Date</label>
                                    <div class='input-group date passport_expiry_date' id='passport_expiry_date'>
                                        <input type='text' class="form-control passport_expiry_date" name="passport_expiry_date[]" required placeholder="Passport Expiration Date"  />
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Visa Entry Type</label>
                                    {!! Form::select('visaentries[]',$visaentries,@$visa_entry_id,[
                                        'class' => 'form-control',
                                        'id'    => 'visa_type_entry_id',
                                        'placeholder'=>'Select Visa Entry Type'
                                        ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-10">
                                <div class="reference-text">Reference site about Lorem Ipsum, giving information on its origins.</div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Upload Passport</label>
                                            <input type="file" name="passport_image[]" id="upload-id" class="inputfile inputfile-1 form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Upload Photo</label>
                                            <input type="file" name="applicant_image[]" id="upload-id-1" class="inputfile inputfile-1 form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="applicants_block"></div>
                    <div class="new-appli-btn">
                        <a class="arrow-btn addapplicant" href="javascript:void(0)"><span class="ab-text">Add New Applicant</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></a>
                    </div>
                </div>

            </div>
        </div>
        <!-- general and application start -->

        <!-- Select Service Type start -->
        <section class="select-servi">
            <div class="container">
                <!-- <div class="sec-title">Select <span class="color-red">Service Type</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div> -->
            </div>
            <div class="type-visa-tab select-servi-tab">
                <!-- <div class="container">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="electronic-tab" data-toggle="pill" href="#electronic" role="tab" aria-controls="electronic" aria-selected="true"><img src="{{asset('images/regular.png') }}" alt=""> <span>Regular</span> <span class="hrs">48 to 50 hrs</span></a>
                        </li>
                        <li class="nav-item nav-express">
                            <a class="nav-link a-express" id="e-visa-tab" data-toggle="pill" href="#e-visa" role="tab" aria-controls="e-visa" aria-selected="false"><img src="{{asset('images/express.png') }}" alt=""> <span>Express</span> <span class="hrs">24 to 26 hrs</span></a>
                        </li>
                        <input type="hidden" name="service_type" id="service_type" value="regular">
                    </ul>
                </div> -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="electronic" role="tabpanel" aria-labelledby="electronic-tab">
                        <div class="container">
                            @if(!empty($visatype->visatype) && !empty($visaentry))
                                <div class="sec-title sec-title-white"><span class="color-red">{{ ucfirst($visatype->visatype->visa_type)  }} </span> <span class="color-red">, {{ ucfirst($visaentry->visa_type_entry)  }}</span> <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                            @else
                                <div class="sec-title sec-title-white"><span class="color-red">Tourist </span> E-Visa<span class="color-red">, Multiple Entry</span> <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                            @endif
                            <div class="multiple-entry">
                                <div class="table-responsive-md">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Visa Type</th>
                                            <th>Visa Entry</th>
                                            <th>Government fee</th>
                                            <th>Processing Days</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($inputs))
                                            <tr>
                                                <td><div class="red-plane"><img src="{{asset('images/plane-red.png') }}" alt=""></div></td>
                                                <td> {{ ucfirst($visatype->visatype->visa_type)  }}</td>
                                                <td> {{ ucfirst($visaentry->visa_type_entry)  }}</td>
                                                <td>AED 
                                                    @php
                                                    $jk1 = $inputs['regular_gov_fee'];
                                                    $jk2 = $gov_fee_tex->service_tax_fee;
                                                    $government_tex = $jk1+$jk2;
                                                    echo $government_tex;
                                                    @endphp
                                                </td>
                                                <td> {{$inputs['processing_fee']}}</td>
                                                <td>
                                                    <button class="arrow-btn yellow-bodr" type="submit" style="border: none;"><span class="ab-text">Continue</span></button>
                                                </td>
                                            </tr>
                                        @else
                                            <td><div class="red-plane"><img src="{{asset('images/plane-red.png') }}" alt=""></div></td>
                                            <td>Tourist Visa</td>
                                            <td>Single</td>
                                            <td>AED 100</td>
                                            <td> 100</td>
                                            <td>
                                                <button class="arrow-btn yellow-bodr" type="submit" style="border: none;"><span class="ab-text">Continue</span></button>
                                            </td>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="e-visa" role="tabpanel" aria-labelledby="e-visa-tab">
                        <div class="container">
                            @if(!empty($visatype->visatype) && !empty($visaentry))
                                <div class="sec-title sec-title-white"><span class="color-red">{{ ucfirst($visatype->visatype->visa_type)  }} </span> <span class="color-red">, {{ ucfirst($visaentry->visa_type_entry)  }}</span> <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                            @else
                                <div class="sec-title sec-title-white"><span class="color-red">Tourist </span> E-Visa<span class="color-red">, Multiple Entry</span> <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                            @endif
                            <div class="multiple-entry">
                                <div class="table-responsive-md">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Visa Type</th>
                                            <th>Visa Entry</th>
                                            <th>Government fee</th>
                                            <th>Processing Days</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($inputs))
                                                <tr>
                                                    <td><div class="red-plane"><img src="{{asset('images/plane-red.png') }}" alt=""></div></td>
                                                    <td> {{ ucfirst($visatype->visatype->visa_type)  }}</td>
                                                    <td> {{ ucfirst($visaentry->visa_type_entry)  }}</td>
                                                    <td>AED {{$inputs['regular_gov_fee']}}</td>
                                                    <td> {{$inputs['processing_fee']}}</td>
                                                    <td>
                                                        <button class="arrow-btn yellow-bodr" type="submit" style="border: none;"><span class="ab-text">Continue</span></button>
                                                    </td>
                                                </tr>
                                            @else
                                                <td><div class="red-plane"><img src="{{asset('images/plane-red.png') }}" alt=""></div></td>
                                                <td>Tourist Visa</td>
                                                <td>Single</td>
                                                <td>AED 100</td>
                                                <td>AED 100</td>
                                                <td>AED 100</td>
                                                <td> 310</td>
                                                <td>
                                                    <button class="arrow-btn yellow-bodr" type="submit" style="border: none;"><span class="ab-text">Continue</span></button>
                                                </td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!empty($inputs))
                        <input type="hidden" name="regular_gov_fee"  value="{{$inputs['regular_gov_fee']}}">
                        <input type="hidden" name="processing_fee"  value="{{$inputs['processing_fee']}}">
                        <input type="hidden" name="visa_detail_id" value="{{$inputs['visa_detail_id']}}">
                        <input type="hidden" name="from_country_id" value="{{$inputs['from_country_id']}}">
                        <input type="hidden" name="visa_type_id" value="{{$inputs['visa_type_id']}}">
                        <input type="hidden" name="visa_entry_id" value="{{$inputs['visa_entry_id']}}">
                        <input type="hidden" name="destination_country_id" value="{{$inputs['destination_country_id']}}">
                    @endif

                </div>
            </div>
        </section>
    {!! Form::close() !!}
    <!-- Select Service Type end -->
    </div>

    <div class="applicant_info hidden">
        <div class="appli-info">
            <div class="appli-info-title">#Applicant <span class="appli_no"></span> <span>(Do fill all the information as in passport)</span>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>First and Middle Name</label>
                        <input type="text" class="form-control first_name" placeholder="First and Middle Name" required name="first_name[]">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control first_name" placeholder="Last Name" name="last_name[]" required>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control custom-select " name="gender[]" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="form-group">
                                    <label>Nationality</label>
                                    {!! Form::select('nationality[]',$nationality_countries,@$nationality_id,[
                                        'class' => 'form-control',
                                        'id'    => 'visa_type_entry_id',
                                        'placeholder'=>'Select Nationality'
                                        ]) !!}
                                </div>
                            </div>
                <!-- <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Nationality</label>
                        <select class="form-control" name="nationality[]"  tabindex="-1" aria-hidden="true">
                            <option value="">Please Select</option>
                            @if(sizeof($countries) > 0)
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> -->
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Birth Date</label>
                        <div class='input-group date sbbirthdate' id='datepicker'>
                            <input type='text' class="form-control" placeholder="Birth Date" name="birthdate[]"   required />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Country of Birth</label>
                        <select class="form-control custom-select" name="birth_country[]"  tabindex="-1" aria-hidden="true">
                            <option value="">Please Select</option>
                            @if(sizeof($countries) > 0)
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Country of Residence</label>
                        {!! Form::select('resident_country[]',$nationality_countries,@$country_residence,[
                                        'class' => 'form-control',
                                        'id'    => 'visa_type_entry_id',
                                        'placeholder'=>'Country of Residence'
                                        ]) !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Passport Number</label>
                        <input type="text" class="form-control" name="passport_number[]" required placeholder="Passport Number">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Passport Issue Date</label>
                        <div class='input-group date passport_issue_date' id='sbbirthdate'>
                            <input type='text' class="form-control" placeholder="Birth Date" name="passport_issue_date[]"   required />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Passport Expiration Date</label>
                        <div class='input-group date passport_expiry_date' id='sbbirthdate'>
                            <input type='text' class="form-control" placeholder="Passport Expiration Date" name="passport_expiry_date[]"   required />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label>Visa Entry Type</label>
                        {!! Form::select('visaentries[]',$visaentries,@$visa_entry_id,[
                                        'class' => 'form-control',
                                        'id'    => 'visa_type_entry_id',
                                        'placeholder'=>'Select Visa Entry Type'
                                        ]) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-10">
                    <div class="reference-text">Reference site about Lorem Ipsum, giving information on its origins.</div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Upload Passport</label>
                                <input type="file" name="passport_image[]" id="" class="inputfile inputfile-1 form-control" >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Upload Photo</label>
                                <input type="file" name="applicant_image[]" id="upload-id-1" class="inputfile inputfile-1 form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label></label>
                                <div class="cust-file">
                                    <div style="cursor:pointer;" class="remove_field btn btn-danger pull-right"><i class="fa fa-close"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .hidden{ display: none !important; }
        .mid-start{padding: 0;}
    </style>
@endsection
@section('scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- datetime picker -->
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <!-- datetime picker -->
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $('#arrival_datetimepicker, #datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: new Date()
            });
            $('#depature_datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD',
                minDate: new Date()
            });

            $('.birthdate, .passport_issue_date, .sbbirthdate').datetimepicker({
                format: 'DD/MM/YYYY',
                maxDate: new Date()
            });

            $('.passport_expiry_date').datetimepicker({
                format: 'DD/MM/YYYY',
                minDate: new Date()
            });

        });
    </script>
    <script>
        // $( ".passport_expiry_date" ).datepicker({
        //     changeMonth: true,
        //     changeYear: true,
        //     minDate: 0
        // });
        //
        // $( ".birthdate, .passport_issue_date, .sbbirthdate" ).datepicker({
        //     changeMonth: true,
        //     changeYear: true,
        //     maxDate: 0
        // });


        $(document).ready(function () {
            $('#electronic-tab').on('click', function () {
                $('#service_type').val('regular');
            });
            $('#e-visa-tab, .nav-express').on('click', function () {
                $('#service_type').val('express');
            });

            var x = 2;
            var max_fields = 30;
            $('.addapplicant').on('click', function (e) {
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    var ss = x++;
                    $('.applicants_block').append('<div class ="removeapplicant remove_test'+ss+'" ">' +$(".applicant_info").html()+'</div>');
                    $('.remove_test'+ss+' .appli-info-title').text('#Applicant '+ss);
                }

                $('.sbbirthdate, .passport_issue_date').datetimepicker({
                    format: 'DD/MM/YYYY',
                    maxDate: new Date()
                });

                $('.passport_expiry_date').datetimepicker({
                    format: 'DD/MM/YYYY',
                    minDate: new Date()
                });

                $('.first_name, .last_name').on('keyup onmouseout keydown keypress blur change', function (event) {
                    var regex = new RegExp("^[a-zA-Z ._\\b\\t]+$");
                    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                    if (!regex.test(key)) {
                        event.preventDefault();
                        return false;
                    }
                });
            });
            $('.applicants_block').on("click",".remove_field", function(e){
                e.preventDefault(); $(this).parents('.removeapplicant').remove(); x--;
            })

            $('.first_name, .last_name').on('keyup onmouseout keydown keypress blur change', function (event) {
                var regex = new RegExp("^[a-zA-Z ._\\b\\t]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });

            // comparison between arrival date and departure date
            $("#arrival_date, #departure_date").on('keyup keydown keypress blur change', function () {
                var fit_start_time  = $("#arrival_date").val();
                var fit_end_time    = $("#departure_date").val();

                if(fit_start_time && fit_end_time){
                    if( new Date(fit_start_time).getTime() >= new Date(fit_end_time).getTime() )
                    {
                        toastr.error('Arrival Date should be Less then Departure Date');
                        $(this).val('');
                    }
                    else
                    {
                        return true; // your code
                    }
                }
            });

        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY',
                minDate: new Date()
            });

        });
    </script>
@endsection
