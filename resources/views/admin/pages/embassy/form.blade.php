<div class="form-group row {{ $errors->has('country_id') ? 'has-error' : '' }}">
    <label class="col-sm-10 col-form-label"><strong>Select Country</strong> <span class="text-danger">*</span></label>

    <div class="col-sm-3 ">
        {!! Form::select('country_id',$country_list,null,[
        'class'         => 'form-control',
        'id'            => 'country_id',
        'placeholder'   => 'Select Country',
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('country_id') ? "".$errors->first('country_id')."" : '' }} </font>
        </span>
    </div>
</div>

<?php if(!empty($embassy)){
?>

<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label"><strong>Enter Embassy Address</strong> <span class="text-danger">*</span></label>
    </div>
    <div class="col-sm-3">
        {!! Form::select('embassy_id',$country_list,null,[
        'class'         => 'form-control',
        'id'            => 'embassy_id',
        'placeholder'   => 'Select Embassy Country',
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('embassy_id') ? "".$errors->first('embassy_id')."" : '' }} </font>
        </span>
    </div>

    <div class="col-sm-7">
        {!! Form::text('address',null,[
                 'class'         => 'form-control',
                 'id'            => 'address',
                 'placeholder'   => 'Enter Address',
            ]) !!}
        {{ Form::hidden('googleaddr', null, array('id' => 'googleaddr')) }}
        {{ Form::hidden('addressLat', null, array('id' => 'addressLat')) }}
        {{ Form::hidden('addressLng', null, array('id' => 'addressLng')) }}
        <span class="help-block">
            <font color="red"> {{ $errors->has('address') ? "".$errors->first('address')."" : '' }} </font>
        </span>
    </div>
</div>

<div class="col-md-6 row">
    <div class="form-group">
        <label class="col-sm-3 col-form-label"><strong>Status</strong></label>
        <div class="i-checks">
            <label>
                {{ Form::radio('status', 'active' ,true,['id'=> 'active']) }} <i></i> Active
            </label>
            <label>
                {{ Form::radio('status', 'block' ,false,['id' => 'inactive']) }}
                <i></i> Block
            </label>
        </div>
        <span class="help-block">
            <font color="red"> {{ $errors->has('status') ? "".$errors->first('status')."" : '' }} </font>
        </span>
    </div>
</div>

<?php }else{

?>
<div class="form-group row">
    <div class="col-sm-12">
        <label class="col-form-label"><strong>Enter Embassy Address</strong> <span class="text-danger">*</span></label>
    </div>
    <div class="col-sm-3">
        {!! Form::select('embassy_id[]',$country_list,null,[
        'class'         => 'form-control',
        'id'            => 'embassy_id',
        'placeholder'   => 'Select Embassy Country',
        ]) !!}
        <span class="help-block">
            <font color="red"> {{ $errors->has('embassy_id') ? "".$errors->first('embassy_id')."" : '' }} </font>
        </span>
    </div>


    <div class="col-sm-7">
        {!! Form::text('address[]',null,[
                 'class'         => 'form-control',
                 'id'            => 'address_id',
                 'placeholder'   => 'Enter Address',
            ]) !!}
        {{ Form::hidden('googleaddr', null, array('id' => 'googleaddr')) }}
        {{ Form::hidden('addressLat', null, array('id' => 'addressLat')) }}
        {{ Form::hidden('addressLng', null, array('id' => 'addressLng')) }}
        <span class="help-block">
            <font color="red"> {{ $errors->has('address') ? "".$errors->first('address')."" : '' }} </font>
        </span>
    </div>
    <div class="col-sm-2">
        <button class="add_field_button btn btn-success active">+</button>
    </div>
</div>
<div class="input_fields_wrap"></div>
<?php }?>
<div class="hr-line-dashed"></div>
<div class="col-sm-4">
    <a href="{{route('admin.embassy.index')}}" class="btn btn-danger btn-sm">Cancel</a>
    <button class="btn btn-primary btn-sm" type="submit">Save</button>
</div>

@section('styles')
@endsection
@section('scripts')
    <link href="{{ asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}" rel="stylesheet">
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
<script type="text/javascript">
    $(document).ready(function() {
        var max_fields = 15; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment

                $(wrapper).append('<div class ="remove_test"><div ><hr class="col-md-11 row"></div><div class="form-group row">' +
                    ' <div class="col-sm-3">' +
                    '        <select class="form-control jembassy_id'+x+'" id="embassy_id" required="" name="embassy_id[]"><option selected="selected" value="">Select Embassy Country</option><option value="1">Mexico</option><option value="2">Spain</option><option value="6">Colombia</option><option value="7">Italy</option><option value="8">India</option></select>' +
                    '        <span class="help-block">' +
                    '            <font color="red">  </font>' +
                    '        </span>' +
                    '    </div>' +
                    '    <div class="col-sm-7">' +
                    '        <input class="form-control" id="address" placeholder="Enter Address" name="address[]" type="text">' +
                    '        <span class="help-block">' +
                    '            <font color="red">  </font>' +
                    '        </span>' +
                    '    </div>' +
                    ' <div class="col-sm-2"><div class="remove_field btn btn-danger"><i class="fa fa-close"></i></div></div></div></div>');

                $.ajax({
                    url:"{{ route('admin.embassy.country') }}",
                    type: 'get',
                    data: {
                    },
                    success:function(result){
                        if(result.countries.length > 0){
                            $('.jembassy_id'+x).html('');
                            var html='';
                            html = '<option value="">Select Embassy Country</option>';
                            jQuery.each(result.countries, function(index, item) {
                                html += '<option value="'+ item.id+'">'+ item.country+'</option>';
                            });
                            $('.jembassy_id'+x).html(html);
                        }
                    },
                    error:function(){
                        swal("Error!", 'Error in updated Record', "error");
                    }
                });
            }
        });
        $(wrapper).on("click",".remove_field", function(e){
            e.preventDefault(); $(this).parents('.remove_test').remove(); x--;
        })
    });
</script>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('address_id');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';

            var place = autocomplete.getPlace();
            var a = place.address_components;
            var zipcode = "";
            var city = "";
            var state = "";
            var country = "";

            $.each(a, function(key,value){
                if(value.types=="locality,political"){
                    city = value.long_name; // city
                }

                if(value.types=="administrative_area_level_1,political"){
                    state = value.long_name; // state
                }

                if(value.types=="country,political"){
                    country = value.long_name; // country
                }

                if(value.types=="postal_code"){
                    zipcode = value.long_name;
                }
            });

            $("#googleaddr").val(place.name+', '+city+', '+state+', '+country+','+zipcode);
            $("#addressLat").val(place.geometry.location.lat());
            $("#addressLng").val(place.geometry.location.lng());
            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
            var radioButton = document.getElementById(id);
            if(radioButton){
                radioButton.addEventListener('click', function() {
                    autocomplete.setTypes(types);
                });
            }
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        var usestrictbounds = document.getElementById('use-strict-bounds');
        if(usestrictbounds){
            usestrictbounds.addEventListener('click', function() {

                autocomplete.setOptions({strictBounds: this.checked});
            });
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjofzTXdIRkmqKx0gAjfwBBImTTgqtVLo&libraries=places&callback=initMap"
        async defer></script>
@endsection
