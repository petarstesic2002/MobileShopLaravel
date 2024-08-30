<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\QueryException;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends AdminController
{
    public function showUsers(){
        return view('admin.pages.users')->with($this->data);
    }
    public function getUsers(Request $request){
        $users=User::with(['address'])->where('role_id','!=',1);
        if($request->get('id')>0){
            $id=$request->get('id');
            $temp=$users->where('id','=',$id);
            $users=$temp;
        }
        $finalUsers=$users->get();
        $usersHTML='';
        if(count($finalUsers)){
            $usersHTML.=View::make('admin.components.users.users_table',['users'=>$finalUsers]);
            return response()->json(['users'=>$usersHTML]);
        }
        else{
            $nothing='<h3 class="text-center">No users to show</h3>';
            return response()->json(['users'=>$nothing]);
        }
    }
    public function showEditUser(){
        $id = Route::current()->parameter('id');
        $user=User::with(['address'])->where('id','=',$id)->first();
        $this->data['to_update']=$user;
        return view('admin.pages.users')->with($this->data);
    }
    public function editUser(Request $request){
        $id=$request->get('id');
        $user=User::where('id','=',$id)->first();
        if($user){
            if($request->get('password')=='no'){
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
                if($validator->passes()){
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

                        return response()->json(['success'=>'Updated user information. Reloading...'],200);
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
                        'password'=>'required|min:6|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
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
                        'password'=>'required|min:6|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
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
                            'password'=>Hash::make($request->get('password'))
                        ]);
                        Address::where('user_id','=',$id)->update([
                            'address_line'=>$request->get('address'),
                            'city'=>$request->get('city'),
                            'postal_code'=>$request->get('zip'),
                            'country'=>$request->get('country')
                        ]);
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
            return response()->json(['errors'=>['User does not exist.']],401);
        }
    }
    public function deleteUser(Request $request){
        $id=$request->get('id');
        $user=User::where('id','=',$id)->first();
        if($user){
            try{
                $user->delete();
                return response()->json(['success'=>'User deleted successfully.'],200);
            }catch(QueryException $ex){
                return response()->json(['errors'=>['User could not be deleted.']],500);
            }
        }
        else{
            return response()->json(['errors'=>['User does not exist.']],401);
        }
    }

    //SHOW INSERT
    public function showAddUser(){
        $this->data['add']=true;
        return view('admin.pages.users')->with($this->data);
    }

    //INSERT USER
    public function addUser(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name'=>'required|alpha|min:2|max:25',
            'last_name'=>'required|alpha|min:2|max:25',
            'email'=>'required|email|unique:users|max:255',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password'=>'required|min:6|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/',
            'address'=>'required|min:3|max:50',
            'city'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
            'country'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
            'zip'=>'required|regex:/^[0-9]{5,}$/'
        ]);
        if($validator->passes()){
            try{
                User::create([
                    'first_name'=>$request->get('first_name'),
                    'last_name'=>$request->get('last_name'),
                    'email'=>$request->get('email'),
                    'password'=>Hash::make($request->get('password')),
                    'phone'=>$request->get('phone'),
                    'role_id'=>2
                ]);
                $user=User::where('email','=',$request->get('email'))->first();
                Address::create([
                    'user_id'=>$user->id,
                    'address_line'=>$request->get('address'),
                    'city'=>$request->get('city'),
                    'postal_code'=>$request->get('zip'),
                    'country'=>$request->get('country')
                ]);
                return response()->json(['success'=>'User created successfully. Redirecting...'],200);
            }catch(QueryException $ex){
                return response()->json(['errors'=>$ex],500);
            }
        }
        else{
            return response()->json(['errors'=>$validator->errors()->all()],406);
        }
    }
    public function userOrders(){
        $id=Route::current()->parameter('id');
        $userWithOrders=User::with(['orders'=>function($orders){
            $orders->orderBy('created_at','desc')->get();
        }])->where('id','=',$id)->first();
        $orders=[];
        foreach($userWithOrders->orders as $order){
            array_push($orders,$order);
        }
        if(count($orders))
            $this->data['orders']=$orders;
        return view('admin.pages.users')->with($this->data);
    }
}
