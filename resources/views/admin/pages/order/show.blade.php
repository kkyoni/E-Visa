<div class="row">
    <div class="col-lg-12 animated fadeInRight">
        <div class="mail-box-header">
            <h3><u>File Number: {{$visaapplication->application_no}}</u></h3>
            <div class="mail-tools tooltip-demo m-t-md">
                <h5>Name: <span class="font-normal">{{$visaapplication->UserDetail->name}}</span></h5>
                <h5>
                    <span class="float-right">WhatsApp:
                        <span class="float-right font-normal">{{$visaapplication->UserDetail->wpmobile}}</span>
                    </span>
                    Email Address: <span class="font-normal">{{$visaapplication->UserDetail->email}}</span>
                </h5>
                <h5>
                    <span class="float-right">Order Status:
                        <span class="float-right font-normal">12345678</span>
                    </span>
                    Moblie Number: <span class="font-normal">{{$visaapplication->UserDetail->mobile}}</span>
                </h5>
                <h5>
                    <span class="float-right">Visa Cost:
                        <span class="float-right font-normal">12345678</span>
                    </span>
                    Visa Type: <span class="font-normal">
                        @if(!empty($visaapplication->visatype))
                            {{  $visaapplication->visatype->visa_type }}
                        @else
                            Tourist Visa
                        @endif
                    </span>
                </h5>
                <h5>Visa Entry Type: <span class="font-normal">
                        @if(!empty($visaapplication->visatypeentry))
                            {{  $visaapplication->visatypeentry->visa_type_entry }}
                        @else
                            Single
                        @endif
                    </span></h5>
            </div>
        </div>
        <br>
        @foreach($visaapplication->visa_applicants as $key =>  $list)
        <div class="mail-box-header">
            <h3><u>Application {{$key+1}} Information</u></h3>
            <div class="mail-tools tooltip-demo m-t-md">
                <h5>
                    <span class="float-right">Last Name:
                        <span class="float-right font-normal">{{$list->last_name}}</span>
                    </span>
                    First & Middle Name: <span class="font-normal">{{$list->first_name}}</span>
                </h5>
                <h5>
                    <span class="float-right">Nationality:
                        <span class="float-right font-normal">
                            @if(!empty($list->applicant_nationality))
                                {{$list->applicant_nationality->country}}
                            @else
                                -
                            @endif
                        </span>
                    </span>
                    Gender: <span class="font-normal">{{$list->gender}}</span>
                </h5>
                <h5>
                    <span class="float-right">Country of Birth:
                        <span class="float-right font-normal">
                            @if(!empty($list->birthcountry))
                                {{$list->birthcountry->country}}
                            @else
                                -
                            @endif
                        </span>
                    </span>
                    Birth Date: <span class="font-normal">{{$list->birthdate}}</span>
                </h5>
                <h5>
                    <span class="float-right">Passport issue date:
                        <span class="float-right font-normal">{{$list->passport_issue_date}}</span>
                    </span>
                    PassPort Number: <span class="font-normal">{{$list->passport_number}}</span>
                </h5>
                <h5>
                    <span class="float-right">Pakistani Member:
                        <span class="float-right font-normal">No</span>
                    </span>
                    PassPort Expiry Date: <span class="font-normal">{{$list->passport_expiry_date}}</span>
                </h5>

                <h5>
                    <span class="float-right">Visa Application Status:
                        <span class="float-right font-normal"> &nbsp;&nbsp;
                            @if($list->status === 'waiting_for_gov')
                                <strong>Waiting for Government Approval</strong>
                            @else
                                <strong>{{ ucfirst($list->status) }}</strong>
                            @endif
                        </span>
                    </span>
                </h5>
            </div>
        </div>

        <div class="mail-box">
            <div class="mail-attachment">
                <p><span><i class="fa fa-paperclip"></i> Document Upload by Application {{$key+1}} </span></p>
                <div class="attachment">
                    <div class="file-box">
                        <div class="file">
                            @if (file_exists(public_path().'/storage/passport_images/'.$list->passport_image))
                                <a href="{{ url('/storage/passport_images/'.$list->passport_image)  }}" target="_blank">
                            @else
                                <a href="{{ url('/storage/avatar/default.png')  }}" target="_blank">
                            @endif
                                <span class="corner"></span>
                                    <div class="icon">
                                        <i class="fa fa-file"></i>
                                    </div>
                                    <div class="file-name">Passport <i class="fa fa-download" aria-hidden="true"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                     <div class="file-box">
                        <div class="file">
                            @if (file_exists(public_path().'/storage/applicant_images/'.$list->applicant_image))
                                <a href="{{ url('/storage/applicant_images/'.$list->applicant_image)  }}" target="_blank">
                            @else
                                <a href="{{ url('/storage/avatar/default.png')  }}" target="_blank">
                            @endif
                                <span class="corner"></span>
                                    <div class="icon">
                                        <i class="fa fa-file"></i>
                                    </div>
                                    <div class="file-name">Photo <i class="fa fa-download" aria-hidden="true"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
            @endforeach
    </div>
</div>
