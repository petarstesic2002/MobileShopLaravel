<div class="row mb-5">
<div class="col-md-6 offset-md-3 my-5">
    <div class="alert alert-success text-center" id="successUpd" style="display:none">
    </div>
    <form class="p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-center">Edit User</h4>
        </div>
        <div class="row mt-2">
            <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" id="firstName" name="firstName" value="{{$to_update->first_name}}"></div>
            <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" id="lastName" name="lastName" value="{{$to_update->last_name}}"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Phone Number</label><input type="text" class="form-control" id="phone" name="phone" value="{{$to_update->phone}}"></div>
            <div class="col-md-12"><label class="labels">Address Line</label><input type="text" class="form-control" id="address" name="address" value="{{$to_update->address->first()->address_line}}"></div>
            <div class="col-md-12"><label class="labels">Postal Code</label><input type="text" class="form-control" id="zip" name="zip" value="{{$to_update->address->first()->postal_code}}"></div>
            <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control" id="city" name="city" value="{{$to_update->address->first()->city}}"></div>
            <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" id="country" name="country" value="{{$to_update->address->first()->country}}"></div>
            <div class="col-md-12"><label class="labels">Email</label><input type="email" class="form-control" id="email" name="email" value="{{$to_update->email}}"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Password - optional</label><input type="password" id="password" name="password" class="form-control" placeholder="Enter new password" value=""></div>
        </div>
        <div class="d-flex mt-5 justify-content-center">
            <div class="text-center"><button class="btn btn-primary profile-button me-1" data-id="{{$to_update->id}}" id="editUserBtn" type="button">Confirm</button></div>
            <div class="text-center"><a class="btn btn-danger profile-button" href="{{url('/admin/users')}}">Back</a></div>
        </div>
    </form>
    <div class="alert alert-danger text-center" id="errorUpd" style="display:none">
    </div>
</div>
</div>
