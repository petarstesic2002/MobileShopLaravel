@extends('layouts.user')
@section('title')
    Electro - Register
@endsection
@section('description')
    Register page
@endsection
@section('keywords')
    register,electro,user
@endsection
@section('content')
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-3 text-center">
            </div>
            <div class="col-md-6 text-center">
                <div class="billing-details">
                    <div class="section-title">
                        <h3 class="title">Register</h3>
                    </div>
                    @include('user.components.login.registerForm')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection