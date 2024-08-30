@extends('layouts.admin')
@section('title')
Electro - Admin - Users
@endsection
@section('content')
    <h1 class="mt-4">Users</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Users Page</li>
    </ol>
    <input type="hidden" id="token" value="{{csrf_token()}}">
    @if(isset($to_update))
        @include('admin.components.users.edit_form')
    @elseif(isset($add))
        @include('admin.components.users.add_form')
    @elseif(isset($orders))
        @include('admin.components.users.user_orders')
    @else
        <div class="row col-md-2">
            <div class="userSearch form-group mb-3">
                <label for="searchUser">Enter User ID - 0 for all</label>
                <input type="number" min="0" id="searchUser" value="0" class="form-control">
            </div>
        </div>
        <div class="row pe-5" id="adminUsers">
        </div>
    @endif
@endsection
