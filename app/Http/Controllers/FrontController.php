<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product as Product;
use Illuminate\Foundation\Http\FormRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class FrontController extends DefaultController
{
    public function index(){

        //3 NAJNOVIJA PROIZVODA
        $product=new Product();
        $newProducts=$product::with(['brand', 'category', 'newestPrice'])
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        $this->data['newProducts']=$newProducts;

        //HOT DEALS SU RANDOM
        $hotDeals=$product::with(['brand', 'category', 'newestPrice'])->inRandomOrder()
            ->take(3)
            ->get();
        $this->data['hotDeals']=$hotDeals;

        return view('user.pages.home')->with($this->data);
    }
    //PRIKAZ LOGIN FORME
    public function showLogin(){
        return view('user.pages.login')->with($this->data);
    }
    //PRIKAZ REGISTER FORME
    public function showRegister(){
        return view('user.pages.register')->with($this->data);
    }
    //DODAVANJE U KORPU
    public function addToCart(Request $request){
        if(!session()->has('cart')){
            $cart=[];
        }
        else{
            $cart=session()->get('cart');
        }
        $id=$request->get('id');
        if(is_numeric($id)&&$id>0){
            $model=new Product();
            $product=$model::find($id);
            if($product){
                $check=0;
                $key=-1;
                foreach($cart as $i=>$p){
                    if($p['product']==$product->id){
                        $check=$p['quantity'];
                        $key=$i;
                    }
                }
                if($check==0){
                    array_push($cart,['product'=>$product->id,'quantity'=>1]);
                }
                else{
                    if($key>=0){
                        $cart[$key]['quantity']++;
                    }
                }
                session()->put('cart',$cart);
                parent::log('addedToCart','user');
                return response('Added to cart.',201);
            }
            else{
                return response('Server error.',500);
            }
        }
        else{
            return response('No such product.',400);
        }
    }
    //SMANJIVANJE KOLICINE PROIZVODA IZ KORPE ILI BRISANJE AKO SE SMANJI SA 1 NA 0
    public function lowerFromCart(Request $request){
        if(!session()->has('cart')){
            return response('Client Error.',404);
        }
        else{
            $cart=session()->get('cart');
        }
        $id=$request->get('id');
        if(is_numeric($id)){
            $i=-1;
            $check=0;
            foreach($cart as $key=>$c){
                if($c['product']==$id){
                    $i=$key;
                    if($c['quantity']>1){
                        $check=1;
                    }
                }
            }
            if($i>=0){
                if($check==1){
                    $cart[$i]['quantity']--;
                    session()->put('cart',$cart);
                    parent::log('loweredFromCart','user');
                    return response(['message'=>'Quantity lowered.','status'=>200],200);
                }
                else{
                    array_splice($cart,$i,1);
                    session()->put('cart',$cart);
                    if(count($cart)<1){
                        session()->forget('cart');
                    }
                    parent::log('clearedCart','user');
                    return response(['message'=>'Product removed.','status'=>201],201);
                }

            }
            else{
                return response('Wrong product.',403);
            }
        }
        else{
            return response('Invalid product.',403);
        }
    }
    //PRIKAZ KORPE
    public function showCart(){
        if(session()->has('cart')){
            $cart=session()->get('cart');
            $this->data['cart']=$cart;
            $productArray=[];
            $model=new Product();
            foreach($cart as $product){
                $item=$model::with(['brand','category','newestPrice'])->where('id','=',$product['product'])->first();
                array_push($productArray,$item);
            }

            $this->data['cartItems']=$productArray;
        }
        return view('user.pages.cart')->with($this->data);
    }
    //BRISANJE KORPE
    public function clearCart(){
        parent::log('clearedCart','user');
        if(session()->has('cart')){
            session()->forget('cart');
            return redirect('/');
        }
        else{
            return redirect('/cart')->with('error','Cart is empty.');
        }
    }

    //SHOW CONTACT
    public function showContact(){
        return view('user.pages.contact')->with($this->data);
    }

    //SENDMAIL
    public function contact(FormRequest $request){
        $request->validate([
            'message'=>'required|min:5|max:255',
            'sendMail'=>'required'
        ]);
        if(!session()->get('user')->email){
            return redirect()->back()->withErrors(['Your email is invalid']);
        }
        else{
            $mail=new PHPMailer();
            try{
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'YOUR_SMTP_HOST';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'YOUR SMTP USERNAME';                     //SMTP username
                $mail->Password   = 'YOUR SMTP PASSWORD';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress('examplemail@example.com');

                //LOGIN PASS ZA GMAIL

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Contact from Electro';
                $mail->Body    = session()->get('user')->email.' says: '.$request->message;
                $mail->AltBody = session()->get('user')->email.' says: '.$request->message;

                $mail->send();
                parent::log('contact','user');
                return redirect()->back()->with('success','Message sent successfully');
            }catch (Exception $e){
                return redirect()->back()->withErrors(['Message could not be sent']);
            }
        }
    }

    //about
    public function about(){
        return view('user.pages.about')->with($this->data);
    }
}
