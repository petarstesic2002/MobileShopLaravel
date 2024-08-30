<div class="col-md-5 border-right">
    <hr/>
    <div class="alert alert-success text-center" id="successUpd" style="display:none">
    </div>
    <form class="p-3 py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-center">Profile Settings</h4>
        </div>
        <div class="row mt-2">
            <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" id="firstName" name="firstName" value="{{$user->first_name}}"></div>
            <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" id="lastName" name="lastName" value="{{$user->last_name}}"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Phone Number</label><input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}"></div>
            <div class="col-md-12"><label class="labels">Address Line</label><input type="text" class="form-control" id="address" name="address" value="{{$user->address->first()->address_line}}"></div>
            <div class="col-md-12"><label class="labels">Postal Code</label><input type="text" class="form-control" id="zip" name="zip" value="{{$user->address->first()->postal_code}}"></div>
            <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control" id="city" name="city" value="{{$user->address->first()->city}}"></div>
            <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" id="country" name="country" value="{{$user->address->first()->country}}"></div>
            <div class="col-md-12"><label class="labels">Email</label><input type="email" class="form-control" id="email" name="email" value="{{$user->email}}"></div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6"><label class="labels">Current Password</label><input type="password" id="password" name="password" class="form-control" placeholder="Enter current password" value=""></div>
            <div class="col-md-6"><label class="labels">New Password</label><input type="password" id="new_password" name="new_password" class="form-control" value="" placeholder="New password (optional)"></div>
        </div>
        <hr/>
        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" data-token="{{csrf_token()}}" data-id="{{$user->id}}" id="editProfileBtn" type="button">Save Profile</button></div>
    </form>
    <hr/>
    <div class="alert alert-danger text-center" id="errorUpd" style="display:none">
    </div>
</div>