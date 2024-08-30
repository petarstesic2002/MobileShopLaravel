@extends('layouts.user')
@section('title')
    Electro - Checkout
@endsection
@section('description')
    Checkout Page
@endsection
@section('keywords')
    electro,checkout,mobile,phone
@endsection
@section('content')
@php
    $priceSum=0;
    foreach ($priceItems as $price) {
        $priceSum+=$price['price']*$price['quantity'];
    }
@endphp
<hr/>
<div class="container">
    <h3 class="title text-center">Checkout</h3>
    @if(Session::has('error'))
        <div class="form-group">
            <span class="text-center alert-danger">{{Session::get('error')}}</span>
        </div>
    @endif
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD) - </span>
                <strong>$ {{number_format($priceSum,2,'.','')}}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <span>Card ending with</span>
                <strong>{{substr(session()->get('cardInfo')->first()->card_number,-4)}}</strong>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <div class="text-center d-flex">
                    <a href="{{url('/purchase')}}" class="btn btn-success text-center">
                        <i class="fa fa-check"></i> PURCHASE
                    </a>
                    <a href="{{url('/cart')}}" class="btn btn-primary text-center">
                        <i class="fa fa-shopping-cart"></i> BACK TO CART
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection