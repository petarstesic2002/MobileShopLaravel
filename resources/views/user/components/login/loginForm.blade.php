<form action="{{ route('login') }}" method="post">
    {{ method_field('POST') }}
    {{ csrf_field() }}
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="form-group">
                    <span class="text-center alert-danger">{{$error}}</span>
                </div>
            @endforeach
        @endif
        <div class="form-group">
            <input class="input" id="email" type="email" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <input class="input" id="password" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input class="loginButton btn btn-danger" type="submit" name="loginButton" value="Login">
        </div>
        <div class="form-group">
            <p>Do not have an account? Register <a href="{{url('/register')}}">here</a>. </p>
        </div>
</form>