<div class="alert alert-danger text-center" id="errorUpd" style="display:none">
</div>
<div class="alert alert-success text-center" id="successUpd" style="display:none">
</div>
<div class="col-2 offset-10 text-right">
    <a class="btn btn-primary text-right" href="{{url('/admin/users/add')}}"><i class="fa fa-plus me-1"></i> Insert</a>
</div>
<div class="table-responsive col-12 container">
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address Line</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Date Created</th>
                <th>Last Update</th>
                <th>Orders</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->first_name.' '.$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->address->first()->address_line}}</td>
                    <td>{{$user->address->first()->city}}</td>
                    <td>{{$user->address->first()->postal_code}}</td>
                    <td>{{$user->address->first()->country}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at?$user->updated_at:$user->created_at}}</td>
                    <td><a class="btn btn-success userOrders d-flex align-items-center justify-content-between" href="{{url('/admin/orders/'.$user->id)}}"><i class="fa fa-eye me-1"></i> Orders</button></td>
                    <td><a class="btn btn-warning text-dark userEdit d-flex align-items-center justify-content-between" href="{{url('/admin/user/'.$user->id)}}"><i class="fa fa-pencil me-1"></i> Edit</a></td>
                    <td><button class="btn btn-danger userDelete d-flex align-items-center justify-content-between" data-token="{{csrf_token()}}" data-id="{{$user->id}}"><i class="fa fa-trash me-1"></i> Delete</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
