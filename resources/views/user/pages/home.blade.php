@extends('layouts.user')
@section('title')
    Electro - Home
@endsection
@section('description')
    Electro Web Shop's landing page
@endsection
@section('keywords')
    electro,laptop,mobile,phone
@endsection
@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1">
                                <div class="row text-center card-group">
                                    @if(count($newProducts))
                                        @foreach($newProducts as $p)
                                            @component('user.components.products.product_preview', ['p'=>$p,'type'=>'NEW'])
                                            @endcomponent
                                        @endforeach
                                    @else
                                        <h3 class="display-4">No Products To Show</h3>
                                    @endif
                                </div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection</p>
                        <a class="primary-btn cta-btn" href="{{url('/items')}}">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Hot Deals</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2">
                                <div class="row text-center">
                                @if(count($hotDeals))
                                    @foreach($hotDeals as $p)
                                            @component('user.components.products.product_preview', ['p'=>$p,'type'=>'HOT'])
                                            @endcomponent
                                    @endforeach
                                @else
                                    <h3 class="display-4">No Products To Show</h3>
                                @endif
                                </div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
