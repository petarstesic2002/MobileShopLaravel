@extends('layouts.user')
@section('title')
    Electro - About
@endsection
@section('description')
    About Page
@endsection
@section('keywords')
    about,electro,author
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
                        <h3 class="title">About</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{asset('assets/img/ja.jpeg')}}">
                        </div>
                        <hr/>
                        <div class="product-details">
                            <h2 class="product-name">Petar Stešić</h2>
                            <div>
                                <h3 class="product-price">9/21</h3>
                            </div>
                            <p>ICT- IT - Web Programiranje</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">Dokumentacija</h2>
                        <a class="btn btn-danger" href="{{asset('dokumentacija.pdf')}}"><i class="fa fa-eye"></i> Dokumentacija</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
