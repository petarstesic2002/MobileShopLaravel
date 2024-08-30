<!-- product -->
<div class="col-md-4 productSingle card">
    <div class="product previewProduct">
        <div class="product-img card-img-top">
            <img src="{{asset('assets/img/products/'.$p->image)}}" alt="{{$p->brand->name}} {{$p->name}}">
            <div class="product-label">
                <span class="new">{{$type}}</span>
            </div>
        </div>
        <div class="product-body">
            <p class="product-category">{{$p->category->name}}</p>
            <h3 class="product-name"><a href="{{url('/item/'.$p->id)}}">{{$p->brand->name}} {{$p->name}}</a></h3>
            <h4 class="product-price">$ {{$p->newestPrice->first()->price}}</h4>
            <div class="product-btns">
                <button class="quick-view viewProduct" data-id="{{$p->id}}"><i class="fa fa-eye"></i><span class="tooltipp">view product</span></button>
            </div>
        </div>
        <div class="add-to-cart">
            <button class="add-to-cart-btn" data-id="{{$p->id}}" data-token="{{csrf_token()}}">
                <i class="fa fa-shopping-cart"></i><span id="popup{{$p->id}}"> add to cart</span>
            </button>
        </div>
    </div>
</div>
<!-- /product -->
