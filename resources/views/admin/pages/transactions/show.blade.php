<table class="table table-bordered">
    <thead>
      <tr>
        <th>Order Id</th>
        <th>Transaction Id</th>
        <th>Application No</th>
        <th>User Name</th>
        <th>Payment Type</th>
        <th>Payment Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$transaction->order_id}}</td>
        <td>{{$transaction->transaction_id}}</td>
        <td>{{$transaction->visa_application->application_no}}</td>
        <td>{{$transaction->user->name}}</td>
        <td>{{$transaction->payment_type}}</td>
        <td>{{$transaction->payment_status}}</td>
      </tr>
    </tbody>
  </table>