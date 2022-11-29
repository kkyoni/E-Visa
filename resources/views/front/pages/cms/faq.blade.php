@extends('front.layouts.app')
@section('title', 'FAQ')
@section('mainContent')
<div class="mid-start">
    <section class="faq">
        <div class="container">
            <div class="sec-title">FAQ  
                <img src="{{asset('images/plane-right.png') }}" alt="">
            </div>
            <div class="faq-choose">
                <div class="form-group">
                    <label>Choose country</label>
                    {!! Form::select('country_id',$country_list,@$country_id,[
                            'class'         => 'form-control select2 custom-select country_id',
                            'tabindex'      => '-1',
                            'aria-hidden'      => 'true',
                            'id'            => 'country_id',
                            'placeholder'   => 'Select Country','required'
                            ]) !!}
{{--                    <select class="form-control custom-select ">--}}
{{--                        <option>Australia</option>--}}
{{--                        <option>India</option>--}}
{{--                        <option>USA</option>--}}
{{--                    </select>--}}
                </div>
                <div class="form-group">
                    <label>Choose visa type</label>
                    {!! Form::select('visa_type_id',$visa_types,@$visatypeid,[
                            'class' => 'form-control select2 custom-select visa_type_id',
                            'tabindex'      => '-1',
                            'aria-hidden'      => 'true',
                            'id'  => 'visa_type_id',
                            'placeholder'   => 'Select Visa '
                            ]) !!}
{{--                    <select class="form-control custom-select ">--}}
{{--                        <option>Tourist E-Visa</option>--}}
{{--                        <option>Visitor E-Visa</option>--}}
{{--                    </select>--}}
                </div>
            </div>
            @if(count($faq_list)>0)
            <div class="faq-acoordion">
                <div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                    @foreach($faq_list as $key => $faq_listing)
                    <div class="card">
                            <a class="collapsed acoo-title" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo{{$key}}" aria-expanded="@if($key == '0') true @else false @endif" aria-controls="collapseTwo{{$key}}">{!! html_entity_decode($faq_listing->question, ENT_QUOTES, 'UTF-8') !!}<span class="acoo-arrow"><img src="{{asset('images/select-arrow.png') }}" alt=""></span></a>
                            <div id="collapseTwo{{$key}}" class="collapse @if($key == '0') show @else  @endif" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                                <div class="card-body">
                                {!! html_entity_decode($faq_listing->answer, ENT_QUOTES, 'UTF-8') !!}
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
                <div class="faq-acoordion">
                    <div class="accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                        <div class="card">
                            <a class="collapsed acoo-title" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="acoo-arrow" style="text-align: center;"><b>Data Record Not Found</b></span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$('#country_id').change(function () {
var  country_id=$(this).val();
if(country_id){
window.location.replace("{{route('front.faq_country',[''])}}"+"/"+country_id);
}else{
window.location.replace("{{ route('front.faq') }}");
}
})
$('#visa_type_id').change(function () {
var  visa_type_id=$(this).val();
if(visa_type_id){
window.location.replace("{{route('front.faq_visatype',[''])}}"+"/"+visa_type_id);
}else{
window.location.replace("{{ route('front.faq') }}");
}
})
</script>
@endsection
