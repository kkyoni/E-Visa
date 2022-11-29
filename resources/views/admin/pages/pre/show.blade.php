<div class="table-responsive">
	<table class="table table-bordered">
		@foreach($prepostpayment as $prepostpayment_list)
		<tr>
			<td>Country</td>
			<td>{{$prepostpayment_list->pre_country->country->country}}</td>
			<td>Visa Type</td>
			<td>
                @if(!empty($prepostpayment_list->pre_country->pre_visa_list))
                    {{$prepostpayment_list->pre_country->pre_visa_list->visa_type}}
                @else
                    -
                @endif
            </td>
		</tr>
		<tr>
			<td>Question</td>
			<td>{{$prepostpayment_list->question}}</td>
		</tr>
		<tr>
			<td>Answer</td>
			<td>{{$prepostpayment_list->answer}}</td>
		</tr>
		<tr>
			<td>Add Droup Down Option</td>
			<td>{{$prepostpayment_list->add_droup}}</td>
			<td>Note</td>
			<td>{{$prepostpayment_list->note}}</td>
			<td>Proceed</td>
			<td>{{$prepostpayment_list->proceed}}</td>
		</tr>
		<tr>
			<td>Tooltip</td>
			<td>{{$prepostpayment_list->tooltip}}</td>
		</tr>
		<tr>
			<td><u><p>Sub Question</p></u></td>
		</tr>
		@endforeach
	</table>
</div>
