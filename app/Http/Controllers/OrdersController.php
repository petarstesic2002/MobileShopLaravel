<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderSession;
use App\Models\OrderItem;

class OrdersController extends DefaultController
{
    public function index(){
        if(User::with(['user_card'])->where('id','=',session()->get('user')->id)->first())
            $user=User::with(['user_card'])->where('id','=',session()->get('user')->id)->first();
        else
            $user=User::where('id','=',session()->get('user')->id)->first();
        if($user){
            if($user->user_card->first()){
                if(session()->has('cart')){
                    $cart=session()->get('cart');
                    $this->data['cart']=$cart;
                    $priceArray=[];
                    $model=new Product();
                    foreach($cart as $key=>$product){
                        $item=$model::with(['newestPrice'])->where('id','=',$product['product'])->first();
                        $priceArray[$key]=[
                            'price'=>$item->newestPrice->first()->price,
                            'quantity'=>$product['quantity']
                        ];
                    }
                    session()->put('cardInfo',$user->user_card);
                    $this->data['priceItems']=$priceArray;
                    return view('user.pages.checkout')->with($this->data);
                }
                else{
                    return redirect()->back()->with('error','Cart is empty.');
                }
            }
            else{
                return redirect('/profile');
            }
        }
        return redirect('/login');
    }
    public function purchase(){
        if(session()->has('cardInfo')){
            if(session()->has('cart')){
                $cart=session()->get('cart');
                $this->data['cart']=$cart;
                $itemArray=[];
                $model=new Product();
                $total=0;
                foreach($cart as $key=>$product){
                    $item=$model::with(['newestPrice'])->where('id','=',$product['product'])->first();
                    $itemArray[$key]=[
                        'id'=>$product['product'],
                        'quantity'=>$product['quantity'],
                        'price'=>$item->newestPrice->first()->id
                    ];
                    $total+=$item->newestPrice->first()->price*$product['quantity'];
                }
                $orderModel=new OrderSession();
                $inserted=$orderModel::create([
                    'user_id'=>session()->get('user')->id,
                    'total'=>$total,
                    'card_id'=>session()->get('cardInfo')->first()->id
                ]);
                if($inserted){
                    $orderItemsModel=new OrderItem();
                    foreach($itemArray as $i){
                        $orderitem=$orderItemsModel::create([
                            'product_id'=>$i['id'],
                            'order_id'=>$inserted->id,
                            'price_id'=>$i['price'],
                            'quantity'=>$i['quantity']
                        ]);
                    }
                    session()->forget('cart');
                    parent::log('purchase','user');
                    return redirect('/profile/orders');
                }
                else{
                    return redirect()->back()->with('error','Unsuccessful operation.');
                }
            }
        }
        else{
            return redirect('/profile');
        }
    }
}
