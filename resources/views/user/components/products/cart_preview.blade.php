<!-- Cart -->
<div class="dropdown">
    <a href="{{route('cart')}}">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="qty">
            @if(session()->has('cart'))
                @php
                    $cart=session()->get('cart');
                    $count=count($cart);
                    foreach($cart as $c){
                        if($c['quantity']>1){
                            for($i=0;$i<$c['quantity']-1;$i++){
                                $count++;
                            }
                        }
                    }
                    echo $count;
                @endphp
            @else
            0
            @endif
        </div>
    </a>
</div>
<!-- /Cart -->