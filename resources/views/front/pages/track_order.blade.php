@extends('front.layouts.app')
@section('title', 'No Visa')
@section('mainContent')

    <div class="header-bottom home-banner">
        <div class="banner-content">
            <div class="container">
                <div class="bc-title">Track Your <br><span class="color-red">VISA </span> Status</div>
                <div class="bc-small-text">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</div>
            </div>
        </div>
    </div>
    </header>
    <!-- mid part start -->
    <div class="mid-start" style="padding: 60px 0;">
        <!-- order status start -->
        <div class="container track-container">
            <div class="order-status">
                <div class="od-number">
                    Order Number <span>{{ $visa_application->application_no  }}</span>
                </div>
                <div class="ready">
                    Ready In: <span>48-52 Hrs</span>
                </div>
            </div>
            @if(!empty($visa_application_applicant))
                @foreach($visa_application_applicant as $key => $visa_applicant)
                    <br><br>
                    <div class="col-md-12 row">
                        <div class="col-md-1"><h3>{{$key+1}}.</h3> </div>
                        <div class="col-md-10"><h3>{{ $visa_applicant->first_name.' '.$visa_applicant->last_name  }}</h3></div>
                    </div>
                    <div class="order-progress">
                        <div class="op-col">
                            <div class="status">
                                @if($visa_applicant->status === 'pending' || $visa_applicant->status === 'in-progress' ||
                                    $visa_applicant->status === 'waiting_for_gov' || $visa_applicant->status === 'completed'
                                    || $visa_applicant->status === 'rejected' || $visa_applicant->status === 'approved')
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @endif
                            </div>
                            <div class="op-title">Recevied Application</div>
                            <div class="op-text">We have received your application and payment.</div>
                        </div>
                        <div class="op-col">
                            <div class="status">
                                @if($visa_applicant->status === 'in-progress' || $visa_applicant->status === 'waiting_for_gov'
                                    || $visa_applicant->status === 'completed' || $visa_applicant->status === 'rejected'
                                    || $visa_applicant->status === 'approved')
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @endif
                            </div>
                            <div class="op-title">In Progress</div>
                            <div class="op-text">We are working on your application.</div>
                        </div>
                        <div class="op-col">
                            <div class="status">
                                @if( $visa_applicant->status === 'waiting_for_gov' || $visa_applicant->status === 'completed'
                                    || $visa_applicant->status === 'rejected' || $visa_applicant->status === 'approved')
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                @endif
                            </div>
                            <div class="op-title">Waiting on Government</div>
                            <div class="op-text">We submitted your info in the government. See comments.</div>
                        </div>

                        @if($visa_applicant->status === 'completed' || $visa_applicant->status === 'approved')
                            <div class="op-col">
                                <div class="status">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </div>
                                <div class="op-title">Complete </div>
                                <div class="op-text">Visa has been emailed. You can also download it.</div>
                            </div>
                        @elseif($visa_applicant->status === 'rejected')
                            <div class="op-col">
                                <div class="status">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </div>
                                <div class="op-title">Rejected </div>
                                <div class="op-text">Your Visa Request has been Rejected because <strong> {{$visa_applicant->reason}}</strong>.</div>
                            </div>
                        @else
                            <div class="op-col">
                                <div class="status"> </div>
                                <div class="op-title">Complete </div>
                                <div class="op-text">Visa has been emailed. You can also download it.</div>
                            </div>
                        @endif

                    </div>
                    <hr>
                @endforeach
            @else
                <div class="order-progress">
                    <div class="op-col">
                        <div class="status"><i class="fa fa-check" aria-hidden="true"></i></div>
                        <div class="op-title">Received Application</div>
                        <div class="op-text">We have received your application and payment.</div>
                    </div>
                    <div class="op-col">
                        <div class="status"><i class="fa fa-check" aria-hidden="true"></i></div>
                        <div class="op-title">In Progress</div>
                        <div class="op-text">We are working on your application.</div>
                    </div>
                    <div class="op-col">
                        <div class="status"></div>
                        <div class="op-title">Waiting on Government</div>
                        <div class="op-text">We submitted your info in the government. See comments.</div>
                    </div>
                    <div class="op-col">
                        <div class="status"></div>
                        <div class="op-title">Complete </div>
                        <div class="op-text">Visa has been emailed. You can also download it.</div>
                    </div>
                </div>
            @endif

            <div class="add-on"><a href="{{route('front.add_on')}}" class="arrow-btn"><span class="ab-text">Add-ons</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></a></div>
        </div>
        <!-- order status start -->


        <section class="order-visa-detail">
            <div class="container">
                <div class="sec-title sec-title-white">Visa <span class="color-red">details</span> <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                <div class="order-detail">
                    <div class="od-top">
                        <div class="od-top-col">
                            <label>Nationality as in passport</label>
                            <div class="country">{{ @$visa_application->arrival_country->country  }}</div>
                        </div>
                        <div class="od-top-col">
                            <label>Travelling to</label>
                            <div class="country">{{ @$visa_application->destination_country->country  }}</div>
                        </div>
                    </div>
                    <ul class="order-detail-ul">
                        <li><label>Visa type :</label> <span>{{ $visa_application->visatype->visa_type  }}</span></li>
                        <li><label>Number of entry :</label> <span>{{ $visa_application->visatypeentry->visa_type_entry  }}</span></li>
                        <li><label>Visa cost :</label> <span>AED {{ $visa_application->total_price  }}</span></li>
                        <li><label>Processing fee :</label> <span>AED 100</span></li>
                        <li><label>Processing time :</label>
                            <span>
                                @if($visa_application->service_type === 'regular')
                                    {{ ucfirst($visa_application->service_type ) }} (48-52 hrs)
                                @else
                                    {{ ucfirst($visa_application->service_type ) }} (24-26 hrs)
                                @endif
                            </span>
                        </li>
                        <li><label>Tax :</label> <span>AED {{ $visa_application->tax  }}</span></li>
                        <li><label>Total Price :</label> <span>AED {{ $visa_application->total_price  }}</span></li>
                    </ul>
                    <div class="order-detail-btn"><a href="javascript:void(0)" class="arrow-btn yellow-bodr print_receipt"><span class="ab-text">Print Receipt</span></a></div>
                </div>
            </div>
        </section>


        <section id="order_visa_detail_receipt" class="hidden">
            <div class="order-detail">
                <div class="od-top">
                    <div class="od-top-col">
                        <label>Nationality as in passport</label>
                        <div class="country">{{ @$visa_application->arrival_country->country  }}</div>
                    </div>
                    <div class="od-top-col">
                        <label>Travelling to</label>
                        <div class="country">{{ $visa_application->destination_country->country  }}</div>
                    </div>
                </div>
                <ul class="order-detail-ul">
                    <li><label>Visa type :</label> <span>{{ $visa_application->visatype->visa_type  }}</span></li>
                    <li><label>Number of entry :</label> <span>{{ $visa_application->visatypeentry->visa_type_entry  }}</span></li>
                    <li><label>Visa cost :</label> <span>AED {{ $visa_application->total_price  }}</span></li>
                    <li><label>Processing fee :</label> <span>AED 100</span></li>
                    <li><label>Processing time :</label>
                        <span>
                            @if($visa_application->service_type === 'regular')
                                {{ ucfirst($visa_application->service_type ) }} (48-52 hrs)
                            @else
                                {{ ucfirst($visa_application->service_type ) }} (24-26 hrs)
                            @endif
                        </span>
                    </li>
                    <li><label>Tax :</label> <span>AED {{ $visa_application->tax  }}</span></li>
                    <li><label>Total Price :</label> <span>AED {{ $visa_application->total_price  }}</span></li>
                </ul>
            </div>
        </section>
        <div id="editor"></div>
{{--        <div id="content">--}}
{{--            <h3>Hello, this is a H3 tag</h3>--}}

{{--            <p>A paragraph</p>--}}
{{--        </div>--}}
{{--        <div id="editor"></div>--}}
{{--        <button id="cmd">generate PDF</button>--}}

    </div>
@endsection
@section('styles')
    <style>
        .hidden{ display: none !important; }
        .mid-start{padding: 0;}
        .track-container{ margin-bottom: 3em; }
        .add-on{
            text-align: right;
            margin-top: 30px;
        }
    </style>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    <script>
        $(document).ready(function () {
            $('#electronic-tab').on('click', function () {
                $('#service_type').val('regular');
            });
            $('#e-visa-tab, .nav-express').on('click', function () {
                $('#service_type').val('express');
            });

            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };

            $('.print_receipt').click(function () {
                doc.fromHTML($('#order_visa_detail_receipt').html(), 15, 15, {
                    'width': 250,
                    'elementHandlers': specialElementHandlers
                });
                doc.save('visa-detail-receipt.pdf');
            });
        });
    </script>
@endsection
