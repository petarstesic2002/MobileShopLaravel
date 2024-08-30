<div class="row mb-5 me-5">
    <div class="col-md-5 offset-md-3 my-5">
        <div class="alert alert-success text-center" id="successAdd" style="display:none">
        </div>
        <div class="alert alert-danger text-center" id="errorAdd" style="display:none">
        </div>
        <form class="p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-center">Add User</h4>
            </div>
            <div class="row mt-2">
                <div class="col-md-6"><label class="labels">First Name</label><input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name"></div>
                <div class="col-md-6"><label class="labels">Last Name</label><input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name"></div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Phone Number</label><input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"></div>
                <div class="col-md-12"><label class="labels">Address Line</label><input type="text" class="form-control" id="address" name="address" placeholder="Address Line"></div>
                <div class="col-md-12"><label class="labels">Postal Code</label><input type="text" class="form-control" id="zip" name="zip" placeholder="Postal Code"></div>
                <div class="col-md-12"><label class="labels">City</label><input type="text" class="form-control" id="city" name="city" placeholder="City"></div>
                <div class="col-md-12"><label class="labels">Country</label><input type="text" class="form-control" id="country" name="country" placeholder="Country"></div>
                <div class="col-md-12"><label class="labels">Email</label><input type="email" class="form-control" id="email" name="email" placeholder="Email"></div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Password</label><input type="password" id="password" name="password" class="form-control" placeholder="Enter password"></div>
            </div>
            <div class="d-flex mt-5 justify-content-center">
                <div class="text-center"><button class="btn btn-success profile-button me-1" id="addUserBtn" data-token="{{csrf_token()}}" type="button">Confirm</button></div>
                <div class="text-center"><a class="btn btn-primary profile-button" href="{{url('/admin/users')}}">View Users</a></div>
            </div>
        </form>
    </div>
</div>
