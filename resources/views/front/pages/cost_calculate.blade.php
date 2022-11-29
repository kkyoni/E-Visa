@extends('front.layouts.app')
@section('title', 'Cost Calculate')
@section('mainContent')
<div class="header-bottom home-banner">
    <div class="banner-content">
        <div class="container">
            <div class="bc-title">Apply for <span class="color-red">Tourist <br> e-visa  </span> From us</div>
            <div class="bc-small-text">Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum generator.</div>
        </div>
    </div>
</div>
</header>
<!-- mid part start -->
<div class="mid-start" style="padding: 60px 0;">
    <div class="container">
        <div class="calculate-cost">
            <div class="sec-title">Calculate Cost For <br> <span class="color-red">Tourist Visa</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
            <div class="calculate-cost-form">
                <div class="form-group form-group col-sm-4" style="margin:0px;">
                    <label>I am residence of</label>
                    <select class="form-control select2 custom-select nationality" name="nationality" tabindex="1" aria-hidden="true">
                        <option value="">Please Select</option>
                        @if(sizeof($countries) > 0)
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->country}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group form-group col-sm-4" style="margin:0px;">
                    <label>Nationality as in passport</label>
                    <select class="form-control select2 custom-select nationality" name="nationality" tabindex="2" aria-hidden="true">
                        <option value="">Please Select</option>
                        @if(sizeof($countries) > 0)
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->country}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group form-group col-sm-4" style="margin:0px;">
                    <label>Travelling to</label>
                    <select class="form-control select2 custom-select travelling_to" name="travelling_to" tabindex="3" aria-hidden="true">
                        <option value="">Please Select</option>
                        @if(sizeof($countries) > 0)
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->country}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group form-group col-sm-4" style="margin: 0px;">
                    <label>Number of enteries</label>
                    <select class="form-control select2 custom-select visa_entry" name="visa_entry" tabindex="4">
                        <option value="">Please Select</option>
                        @if(sizeof($visaentries) > 0)
                        @foreach($visaentries as $entry)
                        <option value="{{$entry->id}}">{{$entry->visa_type_entry}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group form-group col-sm-4" style="margin: 0px;">
                    <label>Number of travellers</label>
                    <input type='number' class="form-control traveller" placeholder="Number of travellers" name="traveller" value="1" min="1" max="100" />
                </div>
            </div>
            <div class="ccf-btn">
                <a href="javascript:void(0);" class="arrow-btn cost_calculate"><span class="ab-text">Calculate cost</span> <img src="{{asset('images/right-arrow-white.png') }}" alt=""></a>
            </div>
        </div>
    </div>

    <!-- <section class="visa-detail">
        <div class="container">
            <div class="sec-title sec-title-white">Visa <span class="color-red">Cost</span> <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
            <div class="multiple-entry">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Visa type</th>
                                <th>Government fee</th>
                                <th>Processing fee</th>
                                <th>Tax</th>
                                <th>Processing Days</th>
                                <th>Price per Traveller</th>
                                <th>Price for Selected Traveller</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="visa_cost_block">
                            <tr>
                                <td>No Visa</td>
                                <td>AED 110</td>
                                <td>AED 100</td>
                                <td>0 %</td>
                                <td>0 Days</td>
                                <td>AED 310</td>
                                <td>AED 310</td>
                                <td><button class="arrow-btn yellow-bodr bon" type="button"><span class="ab-text">Continue</span></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section> -->



    <section class="visa-detail">
            <div class="container">
                <div class="sec-title sec-title-white">Visa <span class="color-red">Cost</span> <img src="{{asset('images/plane-right-white.png') }}" alt=""></div>
                <div class="multiple-entry">
                    <div class="row d-flex align-items-center table-responsive visa_cost_block">
                        <div class="col-md-4">
                            <div class="visa-detail-box">
                                <span>Valid for 60 Days</span>
                                <div class="bdb-title">Medical E-Visa</div>
                                <span>Single Entry</span>
                                <span class="govt-fee">Government Fee</span>
                                <div class="bdb-title">AED 370</div>
                            </div>
                        </div>
                       <div class="col-md-4">
                            <div class="visa-detail-box">
                                <span>Valid for 30 Days</span>
                                <div class="bdb-title">Medical E-Visa</div>
                                <span>Single Entry</span>
                                <span class="govt-fee">Government Fee</span>
                                <div class="bdb-title">AED 370</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="visa-detail-box">
                                <span>Valid for 30 Days</span>
                                <div class="bdb-title">Medical E-Visa</div>
                                <span>Single Entry</span>
                                <span class="govt-fee">Government Fee</span>
                                <div class="bdb-title">AED 370</div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </section>
</div>
@endsection
@section('styles')
<style>
    .hidden{ display: none !important; }
    .mid-start{padding: 0;}
    .recorde{font-family: 'Conv_Gotham-Black'; text-align: center; display: block; color: #0f4373; font-size: 22px; line-height: 25px;padding-bottom: 9px;}
    .multiple-entry .visa-detail-box:hover{border: 1px solid #f15e2d;}
</style>
@endsection
@section('scripts')
<script>
$(document).ready(function () {
    $('.traveller, .processing_time').on('keyup onmouseout keydown keypress blur change', function (event) {
        var regex = new RegExp("^[0-9 ._\\b\\t]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
            event.preventDefault();
            return false;
        }
        if($(this).val() > 100){
            alert("Max. value 100 allowed");
            $(this).val('');
        }
    });

    $('.cost_calculate').on('click', function () {
        var nationality     = $('.nationality').val();
        var visa_entry      = $('.visa_entry').val();
        var traveller       = $('.traveller').val();
        var processing_time = $('.processing_time').val();
        var travelling_to   = $('.travelling_to').val();

        var url = '{{ route('front.apply_now_form')  }}';
        if(nationality && traveller && travelling_to && visa_entry){
            $('.visa_cost_block').html('');
            $.ajax({
                url:"{{ route('front.visa_cost_calculate') }}",
                type: 'get',
                data: {nationality:nationality, travelling_to:travelling_to, visa_entry:visa_entry},
                success:function(result){
                    if(result.status == 'success'){
                        var html='';
                        $.each(result.result, function(key,val) {
                            var total_price= total_amt = price_per_traveller = '';
                            var total_price = parseFloat(val.regular_gov_fee) + parseFloat(val.service_fee);
                            if(val.country.service_tax_fee){
                                total_amt = total_price + (total_price * parseFloat(val.country.service_tax_fee) )/100;
                            }else{
                                total_amt = total_price;
                            }
                            price_per_traveller = parseFloat(traveller) * total_amt;
                            html += '<div class="col-md-4">' +
                            '<div class="visa-detail-box">' +
                            '<span>Valid for ' +  val.processing_day + ' Days</span>' +
                            '<div class="bdb-title">'+ val.visatype.visa_type +'</div>' +
                            '<span>'+ val.visatypeentry.visa_type_entry +'Entry</span>' +
                            '<span class="govt-fee">Government Fee'+'</span>' +
                            '<div class="bdb-title">AED '+ val.regular_gov_fee+'</div>' +
                            '<form method="GET" action="'+url+'" accept-charset="UTF-8">' +
                            '<input type="hidden" name="regular_gov_fee"  value="'+ val.regular_gov_fee +'">'+
                            '<input type="hidden" name="processing_fee"  value="'+ val.service_fee +'">'+
                            '<input type="hidden" name="tax" value="'+ val.country.service_tax_fee +'">'+
                            '<input type="hidden" name="total_price" value="'+ Math.round(price_per_traveller) +'">'+
                            '<input type="hidden" name="visa_detail_id" value="'+ val.country_visa_id +'">'+
                            '<input type="hidden" name="from_country_id" value="'+nationality+'">'+
                            '<input type="hidden" name="visa_entry_id" value="'+visa_entry+'">'+
                            '<input type="hidden" name="destination_country_id" value="'+travelling_to+'">'+
                            '<input type="hidden" name="visa_type_id" value="'+ val.visa_type_id +'">'+
                            '<button class="arrow-btn yellow-bodr" type="submit" style="border: none; margin-top: 15px"><span class="ab-text" style="color:#FFF;">Continue</span></button>' +
                            '</form>'+
                            '</div>'+
                            '</div>';
                            // html += '<tr>' +
                            // '<td>'+ val.visatype.visa_type +'</td>' +
                            // '<td>AED '+ val.regular_gov_fee +'</td>' +
                            // '<td>AED '+ val.service_fee +'</td>' +
                            // '<td>'+ val.country.service_tax_fee +' %</td>' +
                            // '<td>'+ val.processing_day +' Days</td>' +
                            // '<td>AED '+ Math.round(total_amt) +'</td>' +
                            // '<td>AED '+ Math.round(price_per_traveller) +'</td>' +
                            // '<td>' +
                            // '<form method="GET" action="'+url+'" accept-charset="UTF-8">' +
                            // '<input type="hidden" name="regular_gov_fee"  value="'+ val.regular_gov_fee +'">'+
                            // '<input type="hidden" name="processing_fee"  value="'+ val.service_fee +'">'+
                            // '<input type="hidden" name="tax" value="'+ val.country.service_tax_fee +'">'+
                            // '<input type="hidden" name="total_price" value="'+ Math.round(price_per_traveller) +'">'+
                            // '<input type="hidden" name="visa_detail_id" value="'+ val.country_visa_id +'">'+
                            // '<input type="hidden" name="from_country_id" value="'+nationality+'">'+
                            // '<input type="hidden" name="visa_entry_id" value="'+visa_entry+'">'+
                            // '<input type="hidden" name="destination_country_id" value="'+travelling_to+'">'+
                            // '<input type="hidden" name="visa_type_id" value="'+ val.visa_type_id +'">'+
                            // '<button class="arrow-btn yellow-bodr" type="submit" style="border: none;"><span class="ab-text">Continue</span></button>' +
                            // '</form>'+
                            // '</td>' +
                            // '</tr>';
                        });
                        $('.visa_cost_block').html(html);
                    }else{
                        html += '<tr style="width: 100%;">' +
                            '<td class="recorde"> No results found</td>' +
                            '<tr>';
                        $('.visa_cost_block').html(html);

                        // html += '<div class="col-md-12">' +
                        //     '<div class="visa-detail-box">' +
                        //     '<div class="bdb-title"> No results found</div>' +
                        //     '</div>' +
                        //     '</div>';
                        // $('.visa_cost_block').html(html);

                        toastr.error('No Record Found');
                    }
                },error:function(){
                    toastr.error('Error in get Record');
                }
            });
        }
    });
});
</script>
@endsection
