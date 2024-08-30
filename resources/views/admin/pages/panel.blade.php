@extends('layouts.admin')
@section('title')
Electro - Admin
@endsection
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Number Of Users</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white text-start">{{$usersCount}}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Number Of Products</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white text-start">{{$productsCount}}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Number Of Orders</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white text-start">{{$ordersCount}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive col-9 mb-5">
        <h2 class="mt-4">Log</h2>
        <table class="table table-striped mb-5">
            <thead>
                <tr>
                    <th>IP</th>
                    <th>Action</th>
                    <th>User Type</th>
                    <th>Datetime</th>
                </tr>
            </thead>
            <tbody>
                @foreach($log as $key=>$row)
                <tr>
                @php $exploded=explode('|',$row) @endphp
                    @foreach($exploded as $i=>$explode)
                        @if($key!=count($log)-1)
                            @if($i!=count($exploded)-1)
                                <td>{{$explode}}</td>
                            @else
                                <td>{{date('Y-m-d H:i:s',$explode)}}</td>
                            @endif
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
