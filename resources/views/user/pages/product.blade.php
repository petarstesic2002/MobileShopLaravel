@extends('layouts.user')
@section('title')
    Electro - Product Page
@endsection
@section('description')
    Individual product page
@endsection
@section('keywords')
    product,electro,laptop
@endsection
@section('content')
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <div class="product-preview">
                        <img src="{{asset('assets/img/products/'.$product[0]->image)}}" alt="{{$product[0]->name}}">
                    </div>
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    <div class="product-preview">
                        <img src="{{asset('assets/img/products/'.$product[0]->image)}}" alt="{{$product[0]->name}}">
                    </div>
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{$product[0]->name}}</h2>
                    <div>
                        <h3 class="product-price">$ {{$product[0]->newestPrice->first()->price}}</h3>
                    </div>
                    <p>{{$product[0]->description}}</p>

                    <div class="add-to-cart">
                        <button class="add-to-cart-btn popup" data-id="{{$product[0]->id}}" data-token="{{csrf_token()}}">
                            <i class="fa fa-shopping-cart"></i> <span id="popup{{$product[0]->id}}"> add to cart</span>
                        </button>
                    </div>

                    <ul class="product-links">
                        <li>Category:</li>
                        <li><a href="{{url('/items/laptops')}}">{{$product[0]->category->name}}</a></li>
                        <li>Brand:</li>
                        <li><a>{{$product[0]->brand->name}}</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab2">Details</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">{{$product[0]->description}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- details  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table mx-5">
                                    @foreach($product[0]->details as $key=>$detail)
                                        <tr>
                                            <td>{{$detail->name}}</td>
                                            <td>{{$detail->pivot->detail_value}}</td>
                                        </tr>
                                    @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /details  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Related Products</h3>
                </div>
            </div>

            @foreach($relatedProducts as $p)
                @component('user.components.products.product_preview', ['p'=>$p,'type'=>'HOT'])
                @endcomponent
            @endforeach

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->
@endsection
