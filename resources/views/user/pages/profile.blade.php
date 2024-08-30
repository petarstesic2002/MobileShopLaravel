@extends('layouts.user')
@section('title')
    Electro - Profile
@endsection
@section('description')
    Profile Page
@endsection
@section('keywords')
    profile,electro,user
@endsection
@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="avatar"/></div>
            <div class="d-flex justify-content-between align-items-center text-center mb-3">
                <a href="{{url('/profile/orders')}}" class="btn btn-success"><i class="fa fa-shopping-cart"></i> My Orders</a>
            </div>
        </div>
        @include('user.components.profile.edit_profile')
        @component('user.components.profile.edit_card',['user'=>$user])
            
        @endcomponent
    </div>
</div>
@endsection