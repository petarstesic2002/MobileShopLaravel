<div class="row mb-5">
    <div class="col-md-6 offset-md-3 my-5">
        <form class="p-3" enctype="multipart/form-data">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-center">Add Product</h4>
            </div>
            <div class="form-group px-3 row mt-2">
                <label class="labels">Brand</label>
                <select class="form-select" id="brand" name="brand" aria-label="Default select example">
                    @foreach($brands as $b)
                        <option value="{{$b->id}}">{{$b->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group px-3 row mt-2">
                <label class="labels">Category</label>
                <select class="form-select" id="category" name="category" aria-label="Default select example">
                    @foreach($categories as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" id="name" name="name" placeholder="Name"></div>
                <div class="col-md-12"><label class="labels">Price</label><input type="number" min="0" class="form-control" id="price" name="price" placeholder="Price"></div>
                <div class="col-md-12"><label class="labels">Description</label><textarea maxlength="255" type="text" class="form-control" id="description" name="description" placeholder="Description"></textarea></div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><label class="labels">Image</label><input type="file" accept=".jpg,.jpeg,.png" class="form-control" id="image" name="image"></div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <h5 class="text-left">Details</h5>
            </div>
            <div class="row mx-2">
                @foreach ($details as $detail)
                        <div class="col-md-12"><label class="labels">{{$detail->name}}</label><input type="text" class="form-control details" placeholder="Optional" data-id="{{$detail->id}}" id="detail{{$detail->id}}" name="detail{{$detail->id}}"></div>
                @endforeach
            </div>
            <div class="d-flex mt-5 justify-content-center">
                <div class="text-center"><button class="btn btn-success profile-button me-1" data-token="{{csrf_token()}}" id="addProductBtn" type="button">Confirm</button></div>
                <div class="text-center"><a class="btn btn-primary profile-button" href="{{url('/admin/products')}}">View Products</a></div>
            </div>
        </form>
        <div class="alert alert-success text-center" id="successAdd" style="display:none">
        </div>
        <div class="alert alert-danger text-center" id="errorAdd" style="display:none">
        </div>
    </div>
</div>
