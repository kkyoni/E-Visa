<div class="form-group  row {{ $errors->has('country') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label"><strong>Country</strong> <span class="text-danger">*</span></label>
    <div class="col-sm-6">
        {!! Form::text('country',null,[
        'class' => 'form-control',
        'id'    => 'country', 'placeholder'=>'Enter Country'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('country') ? "".$errors->first('country')."" : '' }} </font>
        </span>

    </div>
</div>


<div class="form-group  row {{ $errors->has('service_tax_fee') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label"><strong>Tax on Service Fee</strong> <span class="text-danger">*</span></label>
    <div class="col-sm-6">
        {!! Form::text('service_tax_fee',null,[
        'class' => 'form-control',
        'id'    => 'service_tax_fee','maxlength'=>'4', 'placeholder'=>'Tax on Service Fee'
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('service_tax_fee') ? "".$errors->first('service_tax_fee')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="form-group  row {{ $errors->has('image') ? 'has-error' : '' }}">
    <label class="col-sm-3 col-form-label"><strong>Country Image</strong> <span class="text-danger">*</span></label>
    <div class="col-sm-6">
        <input type="file" class="form-control" name="image">
        <span class="help-block">
            <font color="red"> {{ $errors->has('image') ? "".$errors->first('image')."" : '' }} </font>
        </span>
    </div>

    @if(!empty($country) )
        <div class="img-block col-sm-6 ">
            @if($country->image || !empty($country->image))
                <img src="{{asset('storage/country_flag' . '/' . $country->image)  }}" class="img-tag" style="max-width: 200px; max-height: 200px;margin: 1em;">
            @else
                <img src="{{asset('storage/country_flag/default.png')  }}" class="img-tag" style="max-width: 200px; max-height: 200px;margin: 1em;">
            @endif
        </div>
    @endif

</div>
<div class="hr-line-dashed"></div>
<div class="col-sm-4">
    <input type="hidden" id="country_id" name="country_id">
    <a href="{{ route('admin.country.index')  }}" class="btn btn-danger btn-sm" id="close_language">Close</a>
    <button class="btn btn-primary btn-sm" type="submit">Save</button>
</div>

