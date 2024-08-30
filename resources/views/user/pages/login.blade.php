@extends('layouts.user')
@section('title')
    Electro - Login
@endsection
@section('description')
    Login Page
@endsection
@section('keywords')
    login,electro,user
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
                        <h3 class="title">Login</h3>
                    </div>
                    @include('user.components.login.loginForm')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection