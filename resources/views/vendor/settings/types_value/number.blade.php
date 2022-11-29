<div class="form-group {{ $errors->has('value') ? ' has-error' : '' }}">
    <label class="control-label col-md-2" for="value">Value <sup class="text-danger">*</sup></label>
    <div class="col-md-10">
        <!-- <input class="form-control" name="value" id="value" type="number" placeholder="Value"
               step="{{ config('settings.number_step') }}"
               value="{{ old('value',$setting->value) }}"/> -->
        
        <input class="form-control" name="value" id="value" type="number" placeholder="Value" 
                step="{{ config('settings.number_step') }}" 
                value="{{ old('value',$setting->value) }}" 
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength = "12"/>

        <span class="help-block">
            the value that assigned to this setting.
            <br/>you can change <b>number_step</b> attribute from settings config file.
                        </span>
    </div>
</div>