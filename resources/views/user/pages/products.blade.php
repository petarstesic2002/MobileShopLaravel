@extends('layouts.user')
@section('title')
    Electro - Products Page
@endsection
@section('description')
    Individual products page
@endsection
@section('keywords')
    products,electro,laptop
@endsection
@section('content')
    <input type="hidden" id="token" value="{{csrf_token()}}">
    <div class="container" id="productsPage">
        <div class="row">
            <!-- ASIDE -->
                <div id="aside" class="col-md-3">

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Categories</h3>
                        <div class="checkbox-filter">
                            @foreach($categories as $c)
                                <div class="form-group">
                                    <input type="checkbox" class="categoryCb" name="category{{$c->id}}" id="category{{$c->id}}" value="{{$c->id}}">
                                    <label for="category-1">
                                        {{$c->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Brands</h3>
                        <div class="checkbox-filter">
                            @foreach($brands as $b)
                                <div class="form-group">
                                    <input type="checkbox" class="brandCb" name="brand{{$b->id}}" id="brand{{$b->id}}" value="{{$b->id}}">
                                    <label for="category-1">
                                        {{$b->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Price</h3>
                        <div class="price-filter">
                            <div class="input-number price-min">
                                <h5 class="aside-title">Min</h5>
                                <input id="price-min" min="1" type="number">
                            </div>
                            <br/>
                            <br/>
                            <div class="input-number price-max">
                                <h5 class="aside-title">Max</h5>
                                <input id="price-max" type="number">
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->
                </div>
            <!-- /ASIDE -->
            <div class="col-md-9">
                <div class="col-md-1 text-center">
                </div>
                <div class="col-md-12 d-flex align-items-center text-center searchDiv">
                    <div class="header-search col-md-9 col-12">
                        @include('user.components.products.search')
                    </div>
                    <ul class="store-pagination col-md-3 col-12 text-center" id="pagination">
                </div>
                <div class="col-md-12 row" id="productsDiv"></div>  
                </ul>
            </div>
        </div>
    </div>
@endsection