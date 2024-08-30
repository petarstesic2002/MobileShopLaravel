@extends('layouts.user')
@section('title')
    Electro - Cart
@endsection
@section('description')
    Cart Page
@endsection
@section('keywords')
    electro,cart,mobile,phone
@endsection
@section('content')
<div class="section">
    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="alert alert-warning text-center" style="visibility:hidden" id="alertQty">
                    Hidden
                </div>
                @if(Session::has('error'))
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center alert alert-danger">{{Session::get('error')}}</div>
                @endif
                <div class="col-md-12">
                    <div class="text-right d-flex">
                        @if(session()->has('cart'))
                            <a href="{{url('/clear-cart')}}" class="btn btn-danger text-center">
                                <i class="fa fa-times"></i> CLEAR CART
                            </a>
                            <a href="{{url('/checkout')}}" class="btn btn-primary text-center">
                                <i class="fa fa-shopping-cart"></i> CHECKOUT
                            </a>
                        @endif
                    </div>
                    <hr/>
                    <div class="table-responsive">
                    @if(isset($cartItems))
                        <table class="table mx-5">
                            <tr class="product">
                                <th class="product-body">#</th>
                                <th class="product-body">Image</th>
                                <th class="product-body">Brand</th>
                                <th class="product-body">Name</th>
                                <th class="product-body">Category</th>
                                <th class="product-body">Price</th>
                                <th class="product-body">Quantity</th>
                                <th class="product-body">Total</th>
                            </tr>
                            @php
                                $priceSum=0;
                            @endphp
                            @foreach($cart as $c)
                                @foreach($cartItems as $i=>$item)
                                    @if($item->id==$c['product'])
                                            @php
                                                $priceSum+=$c['quantity']*$item->newestPrice->first()->price;
                                            @endphp
                                        @component('user.components.products.cart_item',['i'=>$i,'item'=>$item,'c'=>$c])
                                        @endcomponent
                                        @if($c['quantity']>1)
                                            @continue
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                            <tr class="product">
                                <td class="product-body"></td>
                                <td class="product-body"></td>
                                <td class="product-body"></td>
                                <td class="product-body"></td>
                                <td class="product-body"></td>
                                <td class="product-body"></td>
                                <th class="product-body">Total Price: </th>
                                <th class="product-body">$ <span id="totalPrice">{{number_format($priceSum,2,'.','')}}</span></th>
                            </tr>
                        </table>
                    </div>
                    @else
                    </div>
                        <h3 class="title text-center">Your cart is empty</h3>
                        <hr/>
                        <div>
                            <div class="text-center">
                                <a href="{{url('/items')}}" class="btn btn-danger text-center">
                                    <i class="fa fa-shopping-cart"></i> SEE OUR PRODUCTS
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection