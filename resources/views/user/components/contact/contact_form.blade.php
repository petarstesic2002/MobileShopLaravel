<form action="{{ route('contact') }}" method="post">
    {{ method_field('POST') }}
    {{ csrf_field() }}
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="form-group">
                    <span class="text-center alert-danger">{{$error}}</span>
                </div>
            @endforeach
        @endif
        @if(Session::has('success'))
            <div class="form-group">
                <span class="text-center alert-success">{{Session::get('success')}}</span>
            </div>
        @endif
        <div class="form-group">
            <textarea class="input" id="message" name="message" placeholder="Send message"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="sendMail" class="btn btn-danger" id="sendMail" value="Send"/>
        </div>
</form>
