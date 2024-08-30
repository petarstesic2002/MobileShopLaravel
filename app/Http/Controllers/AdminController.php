<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderSession;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected array $data;
    public function __construct(){
        $this->middleware(function($request,$next){
            $this->data['user']=session()->get('user');
            return $next($request);
        });
    }
    public function index(){
        $this->data['usersCount']=count(User::all());
        $this->data['productsCount']=count(Product::all());
        $this->data['ordersCount']=count(OrderSession::all());
        $filePath='private/log.txt';
        $content=Storage::get($filePath);
        $explodedContent=explode('\n',$content);
        $this->data['log']=array_reverse($explodedContent,true);

        return view('admin.pages.panel')->with($this->data);
    }
    public function logout(){
        if(session()->has('user'))
            session()->forget('user');
        return redirect('/');
    }

}
