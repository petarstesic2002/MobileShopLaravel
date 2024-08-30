@extends('layouts.user')
@section('title')
    Electro - Orders
@endsection
@section('description')
    Orders Page
@endsection
@section('keywords')
    electro,orders,mobile,phone
@endsection
@section('content')
    @if(isset($orders))
        <div class="container">
            <div class="row">
                <hr/>
                <h3 class="title text-center">Your Orders</h3>
                <div class="container">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">See More</th>
                                    </tr>
                                </thead>
                                @foreach ($orders as $key=>$order)
                                    <tr class="headingRow">
                                        <td class="text-center">Order Number: {{$key+1}}</td>
                                        <td class="text-center">$ {{$order->total}}</td>
                                        <td class="text-center">{{date_format($order->created_at,'d. m. Y.')}}</td>
                                        <td class="text-center"><button class="btn btn-primary showOrderItems" data-id="{{$order->id}}"><i class="fa fa-arrow-down" ></i></button></td>
                                    </tr>
                                    <tr class="orderItem{{$order->id}}" style="display:none">
                                        <th class="text-center">Item</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Item Total</th>
                                    </tr>
                                    @foreach($order->products as $item)
                                        <tr class="orderItem{{$order->id}}" style="display:none">
                                            <td class="text-center">{{$item->name}}</td>
                                            <td class="text-center">{{$item->newestPrice->first()->price}}</td>
                                            <td class="text-center">{{$item->pivot->quantity}}</td>
                                            <td class="text-center">$ {{number_format($item->pivot->quantity*$item->newestPrice->first()->price,2,'.','')}}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <hr/>
        <h3 class="title text-center">No orders</h3>
        <hr/>
        <div>
            <div class="text-center">
                <a href="{{url('/items')}}" class="btn btn-danger text-center">
                    <i class="fa fa-shopping-cart"></i> SEE OUR PRODUCTS
                </a>
            </div>
        </div>
    @endif
@endsection