<div class="table-responsive">
    <table class="table">
        <tbody>
        <tr>
            <td><strong>Destination Country  </strong></td>
            <td class="country">  {{ @$details['country']->country  }}</td>
            <td>|</td>
            <td><strong>Visa Type  </strong></td>
            <td class="visatype">{{ @$details['visatype']->visa_type  }}</td>
        </tr>
        <tr>
            <td><strong>Visa Validity</strong></td>
            <td class="visa_validity">{{@$details->visa_validity}}</td>
            <td>|</td>
            <td><strong>Stay Validity </strong></td>
            <td class="stay_validity">{{@$details->stay_validity}}</td>
        </tr>
        <tr>
            <td><strong>Regular Service Cost </strong></td>
            <td class="regular_service_cost">{{@$details->stay_validity}}</td>
            <td>|</td>
            <td><strong>Express Service Cost </strong></td>
            <td class="express_service_cost">{{@$details->express_service_cost}}</td>
        </tr>

        <tr>
            <td><strong>Service Type : Regular</strong></td>
            <td class="regular_service_type">{{@$details->regular_service_type}}</td>
            <td>|</td>
            <td><strong>Service Type : Express </strong></td>
            <td class="express_service_type">{{@$details->express_service_type}}</td>
        </tr>

        <tr>
            <td><strong>Status</strong></td>
            <td class="status">{{@$details->status}}</td>
            <td>|</td>
            <td><strong>From Country </strong></td>
            <td class="country_from">
                <?php
                    use App\Country;
                    $from_country='';
                    if(!empty($details->from_country)){
                        $countries=array();
                        $countryname='';
                        foreach ($details->from_country as $country){
                            $countryname = Country::where('id', $country->from_country_id)->first()->country;
                            array_push($countries, $countryname);
                        }
                        $from_country = implode(', ', $countries);
                    }
                    echo $from_country;
                ?>
            </td>
        </tr>
        <?php
        if(!empty($details->countryvisafee)){
            foreach ($details->countryvisafee as $fee){?>
                <tr>
                    <td><strong>Visa Type Entry </strong></td>
                    <td class="regular_gov_fee">{{@$fee->visatypeentry->visa_type_entry}}</td>
                    <td>|</td>
                    <td><strong>Goverment Fee : Express </strong></td>
                    <td class="express_gov_fee">{{@$fee->express_gov_fee}}</td>
                    <td>|</td>
                    <td><strong>Goverment Fee : Regular </strong></td>
                    <td class="regular_gov_fee">{{@$fee->regular_gov_fee}}</td>
                </tr>
        <?php     }
        }
        ?>
        <tr>
            <td><strong>Information</strong></td>
            <td class="information">{{@$details->information}}</td>
            <td>|</td>
            <td><strong>Required Documents </strong></td>
            <td class="required_docs">{{@$details->required_docs}}</td>
        </tr>
        </tbody>
    </table>
</div>
