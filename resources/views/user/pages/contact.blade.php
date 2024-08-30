@extends('layouts.user')
@section('title')
    Electro - Contact
@endsection
@section('description')
    Contact Page
@endsection
@section('keywords')
    contact,electro,user
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
                        <h3 class="title">Contact</h3>
                    </div>
                    @include('user.components.contact.contact_form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
