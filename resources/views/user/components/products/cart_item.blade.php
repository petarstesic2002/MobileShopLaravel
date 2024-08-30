<tr class="product">
    <td class="product-body">{{$i+1}}</td>
    <td class="product-body"><img height="50" src="{{asset('assets/img/products/'.$item->image)}}" alt="{{$item->name}}"/></td>
    <td class="product-body">{{$item->brand->name}}</td>
    <td class="product-body">{{$item->name}}</td>
    <td class="product-body">{{$item->category->name}}</td>
    <td class="product-body">$ <span id="price{{$item->id}}">{{$item->newestPrice->first()->price}}</span></td>
    <td class="product-body">
        <div class="product-btns">
            <button class="lower-quantity quick-view" data-id="{{$item->id}}" data-token="{{csrf_token()}}"><i class="fa fa-minus"></i>
                <span class="tooltipp">lower quantity</span>
            </button>
                <span id="quantityCart{{$item->id}}">{{$c['quantity']}}</span> 
            <button class="raise-quantity quick-view" data-id="{{$item->id}}" data-token="{{csrf_token()}}"><i class="fa fa-plus"></i>
                <span class="tooltipp">raise quantity</span>
            </button>
        </div>
    </td>
    <td class="product-body">$ <span id="totalIndividual{{$item->id}}">{{number_format($c['quantity']*$item->newestPrice->first()->price,2,'.','')}}</span></td>
</tr>