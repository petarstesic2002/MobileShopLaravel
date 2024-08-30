<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCard;
use App\Models\Address;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(Request $request){
        if(!session()->has('user')){
            $model = new User();
            $email=$request->get("email");
            $password=$request->get("password");
            $user=$model::with(['address'])->where('email','=',$email)->first();
            if($user){
                if(Hash::check($password, $user->password)){
                    $request->session()->put('user',$user);
                    //USER role_id 1 - admin, 2 - user
                    if(UserCard::where('user_id','=',$user->id)->first()){
                        $card=UserCard::where('user_id','=',$user->id)->first();
                        session()->put('cardInfo',$card);
                    }
                    if($user->role_id!=1)
                        parent::log('login','user');
                    return $user->role_id==1 ? redirect(url('/admin')):redirect(url('/'));
                }
                else{
                    return redirect()->back()->withErrors(['errors'=>'Wrong password.']);
                }
            }
            else{
                return redirect()->back()->withErrors(['errors'=>'An account with this email does not exist.']);
            }
        }
        else{
            return redirect('/');
        }
    }
    public function logout(){
        parent::log('logout','user');
        session()->forget('user');
        if(session()->has('cardInfo')){
            session()->forget('cardInfo');
        }
        return redirect(url('/'));
    }
    public function register(FormRequest $request){
        if(!session()->has('user')){
            $request->validate([
                'firstName'=>'required|alpha|min:2|max:25',
                'lastName'=>'required|alpha|min:2|max:25',
                'email'=>'required|email|unique:users|max:255',
                'password'=>'required|min:6|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/|confirmed',
                'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'address'=>'required|min:3|max:50',
                'city'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                'country'=>'required|regex:/^[A-Z][a-z]{1,}[A-z\s]{2,}$/|min:2|max:30',
                'zip'=>'required|regex:/^[0-9]{5,}$/'
            ]);
            $model=new User();
            try{
                $model::create([
                    'first_name'=>$request->firstName,
                    'last_name'=>$request->lastName,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'phone'=>$request->phone,
                    'role_id'=>2
                ]);
                $inserted=$model::where('email','=',$request->email)->first();
                if($inserted){
                    $addressModel=new Address();
                    $addressModel::create([
                        'user_id'=>$inserted->id,
                        'address_line'=>$request->address,
                        'city'=>$request->city,
                        'postal_code'=>$request->zip,
                        'country'=>$request->country
                    ]);
                    parent::log('register','guest');
                    return redirect()->back()->with('success','Registration successful.');
                }
                else{
                    return redirect()->back()->with('error','Operation unsuccessful.');
                }
            }catch(QueryException $ex){
                return redirect()->back()->with('error','Server error.');
            }
        }
        else{
            return redirect('/');
        }
    }
}
