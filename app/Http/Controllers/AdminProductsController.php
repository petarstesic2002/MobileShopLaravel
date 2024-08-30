<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Detail;
use App\Models\Price;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\View;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Intervention\Image\Facades\Image;

class AdminProductsController extends AdminController
{
    //PRIKAZ PROIZVODA
    public function showProducts(){
        return view('admin.pages.products')->with($this->data);
    }

    //DOHVATANJE PROIZVODA
    public function getProducts(Request $request){
        $products=Product::with(['category','brand','newestPrice']);
        $finalProducts=null;
        $responseView="";
        if($request->get('id')!=0){
            $temp=$products->where('id','=',$request->get('id'));
            $products=$temp;
        }
        $finalProducts=$products->get();
        if(count($finalProducts)){
            $responseView.=View::make('admin.components.products.products_table',['products'=>$finalProducts]);
            return response()->json(['products'=>$responseView],200);
        }
        else{
            $response='<h3>No products to show</h3>';
            return response()->json(['products'=>$response],200);
        }
    }

    //POSTAVLAJNJE BRENDOVA I KATEGORIJA ZA SELECT
    public function brandsCategoriesDetails(){
        $this->data['brands']=Brand::all();
        $this->data['categories']=Category::all();
        $this->data['details']=Detail::all();
    }

    //BRISANJE PROIZVODA
    public function deleteProduct(Request $request){
        $id=$request->get('id');
        $product=Product::where('id','=',$id)->first();
        if($product){
            try{
                $product->delete();
                return response()->json(['success'=>'Product deleted successfully.'],200);
            }catch(QueryException $ex){
                return response()->json(['errors'=>['Product could not be deleted.']],500);
            }
        }
        else{
            return response()->json(['errors'=>['Product does not exist.']],401);
        }
    }

    //PRIKAZ EDIT FORME
    public function showEditProduct(){
        $this->brandsCategoriesDetails();
        $id = Route::current()->parameter('id');
        $product=Product::with(['details','brand','category','newestPrice'])->where('id','=',$id)->first();
        $this->data['to_update']=$product;
        $this->data['hasDetails']=Product::hasDetails($id);
        $this->data['notDetails']=Product::notDetails($id);
        return view('admin.pages.products')->with($this->data);
    }

    //UPDATE PROIZVODA
    public function editProduct(FormRequest $request){
        if($request->file('file')!=null){
            $validator = Validator::make($request->all(),[
                'name'=>'required|min:2|max:25',
                'brand'=>'required|integer|min:1',
                'category'=>'required|integer|min:1',
                'price'=>'required|numeric|between:1,99999999999999',
                'description'=>'required|min:2',
                'file' => File::image()->max(12 * 1024),
                'details.*.id'=>'integer|min:1'
            ]);
        }
        else{
            $validator = Validator::make($request->all(),[
                'name'=>'required|min:2|max:25',
                'brand'=>'required|integer|min:1',
                'category'=>'required|integer|min:1',
                'price'=>'required|numeric|between:1,99999999999999',
                'description'=>'required|min:2',
                'details.*.id'=>'integer|min:1'
            ]);
        }
        if($validator->passes()){
            try{
                if($request->file('file')!=null){
                    $fileNameToAdd=uniqid().$request->file('file')->getClientOriginalName();
                    Product::where('id','=',$request->get('id'))->update([
                        'name'=>$request->get('name'),
                        'description'=>$request->get('description'),
                        'brand_id'=>$request->get('brand'),
                        'category_id'=>$request->get('category'),
                        'image'=>$fileNameToAdd
                    ]);
                    $request->file('file')->move(public_path().'/assets/img/products/',$fileNameToAdd);
                }
                else{
                    Product::where('id','=',$request->get('id'))->update([
                        'name'=>$request->get('name'),
                        'description'=>$request->get('description'),
                        'brand_id'=>$request->get('brand'),
                        'category_id'=>$request->get('category')
                    ]);
                }
                foreach($request->get('details') as $detailJSON){
                    $detail=json_decode($detailJSON);
                    if($detail->value==''||$detail->value==null){
                        if(ProductDetail::where('product_id','=',$request->get('id'))->where('detail_id','=',$detail->id)->first())
                            ProductDetail::where('product_id','=',$request->get('id'))->where('detail_id','=',$detail->id)->delete();
                    }
                    else{
                        if(ProductDetail::where('product_id','=',$request->get('id'))->where('detail_id','=',$detail->id)->first()){
                            ProductDetail::where('product_id','=',$request->get('id'))->where('detail_id','=',$detail->id)->update([
                                'detail_value'=>$detail->value
                            ]);
                        }
                        else{
                            ProductDetail::create([
                                'detail_value'=>$detail->value,
                                'product_id'=>$request->get('id'),
                                'detail_id'=>$detail->id
                            ]);
                        }
                    }
                    continue;
                }
                Price::where('product_id','=',$request->get('id'))->update([
                    'price'=>$request->get('price')
                ]);
                return response()->json(['success'=>['Product info updated. Redirecting...']],200);

            }catch(QueryException $ex){
                return response()->json(['errors'=>['Product info could not be updated.']],500);
            }
        }
        else{
            return response()->json(['errors'=>$validator->errors()->all()],406);
        }
    }

    //SHOW INSERT FORM
    public function showAdd(){
        $this->brandsCategoriesDetails();
        $this->data['add']=true;
        $this->data['details']=Detail::all();
        return view('admin.pages.products')->with($this->data);
    }

    //ADD PRODUCTS
    public function addProduct(FormRequest $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|min:2|max:25',
            'brand'=>'required|integer|min:1',
            'category'=>'required|integer|min:1',
            'price'=>'required|numeric|between:1,99999999999999',
            'description'=>'required|min:2',
            'file' => ['required',File::image()->max(12 * 1024)],
            'details.*.id'=>'integer|min:1'
        ]);
        if($validator->passes()){
            try{
                $fileNameToAdd=uniqid().$request->file('file')->getClientOriginalName();
                $inserted=$product=Product::create([
                    'name'=>$request->get('name'),
                    'description'=>$request->get('description'),
                    'brand_id'=>$request->get('brand'),
                    'category_id'=>$request->get('category'),
                    'image'=>$fileNameToAdd
                ]);
                $request->file('file')->move(public_path().'/assets/img/products/',$fileNameToAdd);
                foreach($request->get('details') as $detailJSON){
                    $detail=json_decode($detailJSON);
                    if($detail->value!=''||$detail->value!=null){
                        ProductDetail::create([
                            'detail_value'=>$detail->value,
                            'product_id'=>$inserted->id,
                            'detail_id'=>$detail->id
                        ]);
                    }
                }
                Price::create([
                    'product_id'=>$product->id,
                    'price'=>$request->get('price')
                ]);
                return response()->json(['success'=>['Product created successfully. Redirecting...']],200);
            }catch(QueryException $ex){
                return response()->json(['errors'=>[$ex]],500);
            }
        }
        else{
            return response()->json(['errors'=>$validator->errors()->all()],406);
        }
    }
}
