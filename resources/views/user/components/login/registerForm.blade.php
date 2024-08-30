<form action="{{ route('register') }}" method="post">
    {{ method_field('POST') }}
    {{ csrf_field() }}
        @if($errors->any())
            <div class="form-group">
                @foreach($errors->all() as $error)
                    <span class="text-center alert-danger">{{$error}}</span>
                @endforeach
            </div>
        @endif
        @if(Session::has('error'))
            <div class="form-group">
                <span class="text-center alert-danger">{{Session::get('error')}}</span>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="form-group">
                <span class="text-center alert-success">{{Session::get('success')}}</span>
            </div>
        @endif
        <div class="form-group">
            <div class="text-left">
                <h4>First Name</h4>
            </div>
            <input class="input" id="firstName" type="text" name="firstName" placeholder="First Name">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>Last Name</h4>
            </div>
            <input class="input" id="lastName" type="text" name="lastName" placeholder="Last Name">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>Phone Number</h4>
            </div>
            <input class="input" id="phone" type="text" name="phone" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>E-mail</h4>
            </div>
            <input class="input" id="email" type="email" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>Password</h4>
            </div>
            <input class="input" id="password" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>Repeat Password</h4>
            </div>
            <input class="input" id="password_confirmation" type="password" name="password_confirmation" placeholder="Repeat Password">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>Address Line</h4>
            </div>
            <input class="input" id="address" type="text" name="address" placeholder="Address Line">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>City</h4>
            </div>
            <input class="input" id="city" type="text" name="city" placeholder="City">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>Postal Code</h4>
            </div>
            <input class="input" id="zip" type="text" name="zip" placeholder="Postal Code">
        </div>
        <div class="form-group">
            <div class="text-left">
                <h4>Country</h4>
            </div>
            <input class="input" id="country" type="text" name="country" placeholder="Country">
        </div>
        <div class="form-group">
            <input class="loginButton btn btn-danger" type="submit" name="loginButton" value="Register">
        </div>
        <div class="form-group">
            <p>Already have an account? Login <a href="{{url('/login')}}">here</a>. </p>
        </div>
</form>