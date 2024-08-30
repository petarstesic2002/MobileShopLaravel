<div class="alert alert-danger text-center" id="errorUpd" style="display:none">
</div>
<div class="alert alert-success text-center" id="successUpd" style="display:none">
</div>
<div class="col-2 offset-10">
    <a class="btn btn-primary d-inline-flex align-items-center" href="{{url('/admin/products/add')}}"><i class="fa fa-plus me-1"></i> Insert</a>
</div>
<div class="table-responsive col-12 container mb-5">
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="align-middle">{{$product->id}}</td>
                    <td class="align-middle"><img width="150px" src="{{asset('assets/img/products/'.$product->image)}}"></td>
                    <td class="align-middle">{{$product->brand->name}}</td>
                    <td class="align-middle">{{$product->name}}</td>
                    <td class="align-middle">{{$product->category->name}}</td>
                    <td class="align-middle">{{$product->created_at}}</td>
                    <td class="align-middle">{{$product->updated_at?$product->updated_at:$product->created_at}}</td>
                    <td class="align-middle"><a class="btn btn-warning text-dark productEdit d-inline-flex align-items-center" href="{{url('/admin/product/'.$product->id)}}"><i class="fa fa-pencil me-1"></i> Edit</a></td>
                    <td class="align-middle"><button class="btn btn-danger productDelete d-flex align-items-center justify-content-between" data-token="{{csrf_token()}}" data-id="{{$product->id}}"><i class="fa fa-trash me-1"></i> Delete</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
