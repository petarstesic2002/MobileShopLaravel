<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\UserCard;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends DefaultController
{
    public function index(){
        if(User::with(['user_card'])->where('id','=',session()->get('user')->id)->first())
            $this->data['user']=User::with(['user_card'])->where('id','=',session()->get('user')->id)->first();
        else
            $this->data['user']=User::where('id','=',session()->get('user')->id)->first();
        return view('user.pages.profile')->with($this->data);
    }
    public function editProfile(Request $request){
        $id=$request->get('id');
        $user=User::where('id','=',$id)->first();
        if($user){
            if(Hash::check($request->get('password'),$user->password)){
                if($request->get('new_password')=='no'||($request->get('password')==$request->get('new_password'))){
                    if($request->get('email')==$user->email){
                        $validator = Validator::make($request->all(),[
                            'first_name'=>'required|alpha|min:2|max:25',
                            'last_name'=>'required|alpha|min:2|max:25',
                            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                            'address'=>'required|min:3|max:50',
                            'city'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                            'country'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                            'zip'=>'required|regex:/^[0-9]{5,}$/'
                        ]);
                    }
                    else{
                        $validator = Validator::make($request->all(),[
                            'first_name'=>'required|alpha|min:2|max:25',
                            'last_name'=>'required|alpha|min:2|max:25',
                            'email'=>'required|email|unique:users|max:255',
                            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                            'address'=>'required|min:3|max:50',
                            'city'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                            'country'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                            'zip'=>'required|regex:/^[0-9]{5,}$/'
                        ]);
                    }
                    if ($validator->passes()) {
                        try{
                            User::where('id','=',$id)->update([
                                'first_name'=>$request->get('first_name'),
                                'last_name'=>$request->get('last_name'),
                                'email'=>$request->get('email'),
                                'phone'=>$request->get('phone')
                            ]);
                            Address::where('user_id','=',$id)->update([
                                'address_line'=>$request->get('address'),
                                'city'=>$request->get('city'),
                                'postal_code'=>$request->get('zip'),
                                'country'=>$request->get('country')
                            ]);

                            session()->put('user',User::with(['address'])->where('id','=',$id)->first());
                            parent::log('editedProfile','user');
                            return response(['success'=>'Updated user information. Reloading...'],200);
                        }catch(QueryException $ex){
                            return response()->json(['errors'=>['Server error.']],500);
                        }
                    }
                    else{
                        return response()->json(['errors'=>$validator->errors()->all()],406);
                    }
                }
                else{
                    if($request->get('email')==$user->email){
                        $validator = Validator::make($request->all(),[
                            'first_name'=>'required|alpha|min:2|max:25',
                            'last_name'=>'required|alpha|min:2|max:25',
                            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                            'new_password'=>'required|min:6|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
                            'address'=>'required|min:3|max:50',
                            'city'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                            'country'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                            'zip'=>'required|regex:/^[0-9]{5,}$/'
                        ]);
                    }
                    else{
                        $validator = Validator::make($request->all(),[
                            'first_name'=>'required|alpha|min:2|max:25',
                            'last_name'=>'required|alpha|min:2|max:25',
                            'email'=>'required|email|unique:users|max:255',
                            'new_password'=>'required|min:6|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
                            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                            'address'=>'required|min:3|max:50',
                            'city'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                            'country'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                            'zip'=>'required|regex:/^[0-9]{5,}$/'
                        ]);
                    }
                    if ($validator->passes()) {
                        try{
                            User::where('id','=',$id)->update([
                                'first_name'=>$request->get('first_name'),
                                'last_name'=>$request->get('last_name'),
                                'email'=>$request->get('email'),
                                'phone'=>$request->get('phone'),
                                'password'=>Hash::make($request->get('new_password'))
                            ]);
                            Address::where('user_id','=',$id)->update([
                                'address_line'=>$request->get('address'),
                                'city'=>$request->get('city'),
                                'postal_code'=>$request->get('zip'),
                                'country'=>$request->get('country')
                            ]);
                            parent::log('editedProfile','user');
                            session()->put('user',User::with(['address'])->where('id','=',$id)->first());
                            return response()->json(['success'=>'Updated user information. Reloading...'],200);
                        }catch(QueryException $ex){
                            return response()->json(['errors'=>['Server error.']],500);
                        }
                    }
                    else{
                        return response()->json(['errors'=>$validator->errors()->all()],406);
                    }
                }
            }
            else{
                return response()->json(['errors'=>['Wrong password.']],401);
            }
        }
        else{
            return response()->json(['errors'=>['User does not exist.']],404);
        }
    }
    public function editCard(Request $request){
        $id=$request->get('id');
        $user=User::with(['user_card'])->where('id','=',$id)->first();
        if($user){
            if($request->get('new_card')=='no'){
                if($request->get('card')==$user->user_card->first()->card_number){
                    $validator = Validator::make($request->all(),[
                        'date'=>'required|date_format:Y-m-d|after:today'
                    ]);
                    if ($validator->passes()){
                        UserCard::where('user_id','=',$id)->update([
                            'expiry_date'=>$request->get('date')
                        ]);
                        $card=UserCard::where('user_id','=',$id)->first();
                        return response()->json(['success'=>'Updated card information. Reloading...'],200);
                    }
                    else{
                        return response()->json(['errors'=>$validator->errors()->all()],406);
                    }
                }
                else{
                    return response()->json(['errors'=>['Current Card Number is required.']],404);
                }
            }
            else{
                $validator = Validator::make($request->all(),[
                    'date'=>'required|date_format:Y-m-d|after:today',
                    'new_card'=>'required|regex:/^[0-9]{5,}$/'
                ]);
                if ($validator->passes()){
                    $card=UserCard::where('user_id','=',$id)->first();
                    if($card){
                        UserCard::where('user_id','=',$id)->update([
                            'card_number'=>$request->get('new_card'),
                            'expiry_date'=>$request->get('date')
                        ]);
                        parent::log('editedCard','user');
                        return response()->json(['success'=>'Updated card information. Reloading...'],200);
                    }
                    else{
                        UserCard::create([
                            'user_id'=>$id,
                            'card_number'=>$request->get('new_card'),
                            'expiry_date'=>$request->get('date')
                        ]);
                        $cardModel=new UserCard();
                        $userCard=$cardModel::where('user_id','=',$id)->first();
                        parent::log('addedCard','user');
                        return response()->json(['success'=>'Updated card information. Reloading...'],200);
                    }
                }
                else{
                    return response()->json(['errors'=>$validator->errors()->all()],406);
                }
            }
        }
        else{
            return response()->json(['errors'=>['Invalid user.']],404);
        }
    }
    public function userOrders(){
        $user=session()->get('user');
        $userWithOrders=User::with(['orders'=>function($orders){
            $orders->orderBy('created_at','desc')->get();
        }])->where('id','=',$user->id)->first();
        $orders=[];
        foreach($userWithOrders->orders as $order){
            array_push($orders,$order);
        }
        if(count($orders))
            $this->data['orders']=$orders;
        return view('user.pages.orders')->with($this->data);
    }
}
