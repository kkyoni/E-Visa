<table class="table table-bordered">
    <thead>
      <tr>
        <th>User Name</th>
        <th>Email</th>
        <th>Contact No</th>
        <th>country</th>
        <th>Messages</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$contactus->name}}</td>
        <td>{{$contactus->email}}</td>
        <td>{{$contactus->contact_no}}</td>
        <td>{{$contactus->country_list->country}}</td>
        <td>{{$contactus->message}}</td>
        <td>{{$contactus->admin_read}}</td>
      </tr>
    </tbody>
  </table>