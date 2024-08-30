<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class ProductsController extends DefaultController
{
    public function index(){
        $this->data['brands']=Brand::all();
        $this->data['categories']=Category::all();
        return view('user.pages.products')->with($this->data);
    }
    public function show(){
        //JEDAN PROIZVOD
        $id = Route::current()->parameter('id');
        $product=new Product();
        $p=$product::with(['brand','category','newestPrice','details'])->where('id','=',$id)->get();
        $this->data['product']=$p;

        //3 PROIZVODA SA ISTOM KATEGORIJOM
        $relatedProducts=$product::with(['brand','category','newestPrice'])->where('category_id','=',$p[0]->category_id)->where('id','!=',$p[0]->id)->take(3)->get();
        $this->data['relatedProducts']=$relatedProducts;
        return view('user.pages.product')->with($this->data);
    }
    public function getProducts(Request $request){
        $products=Product::with(['category','brand','newestPrice']);
        $finalProducts=null;
        $responseView="";
        if($request->get('categories')!=0){
            $categories=$request->get('categories');
            $temp=$products->whereIn('category_id',$categories);
            $products=$temp;
        }
        if($request->get('brands')!=0){
            $brands=$request->get('brands');
            $temp=$products->whereIn('brand_id',$brands);
            $products=$temp;
        }
        if($request->get('minPrice')>0){
            $min=$request->get('minPrice');
            $temp=$products->whereRelation('newestPrice','price','>',$min);
            $products=$temp;
        }
        if($request->get('maxPrice')>0){
            $max=$request->get('maxPrice');
            $temp=$products->whereRelation('newestPrice','price','<',$max);
            $products=$temp;
        }
        if($request->get('search')!=NULL){
            $search=$request->get('search');
            $temp=$products->where('name','like','%'.$search.'%')->orWhereRelation('brand','name','like','%'.$search.'%');
            $products=$temp;
        }
        //PAGINACIJA
        $finalProducts=$products->get();
        $page=intval($request->get('page'));
        $limit=6;
        $totalPages=ceil(count($finalProducts)/$limit);
        $startLimit=($page-1)*$limit;
        $paginatedProducts=$products->skip($startLimit)->take($limit)->get();
        $paginationView="";
        $currentPage=$page;
        if(count($paginatedProducts)){
            foreach ($paginatedProducts as $key => $product) {
                $responseView.=View::make("user.components.products.product_preview",['p'=>$product,'type'=>'HOT']);
            }
            if($totalPages==1)
                $paginationView.=View::make('user.components.products.pagination',['num'=>1,'class'=>" active"]);
            if($totalPages==2){
                $paginationView.=View::make('user.components.products.pagination',['num'=>1,'class'=>($currentPage==1)?' active':' inactive']);
                $paginationView.=View::make('user.components.products.pagination',['num'=>2,'class'=>($currentPage==2)?' active':' inactive']);
            }
            if($totalPages>2){
                if($page==1){
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage,'class'=>' active']);
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage+1,'class'=>' inactive']);
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage+2,'class'=>' inactive']);
                }
                else if($page==$totalPages){
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage-2,'class'=>' inactive']);
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage-1,'class'=>' inactive']);
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage,'class'=>' active']);
                }
                else{
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage-1,'class'=>' inactive']);
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage,'class'=>' active']);
                    $paginationView.=View::make('user.components.products.pagination',['num'=>$currentPage+1,'class'=>' inactive']);
                }
            }
            return response()->json(['reply'=>$responseView,'pagination'=>$paginationView],200);
        }
        else{
            $response='<h3>No products to show</h3>';
            return response()->json(['reply'=>$response],200);
        }
    }
}
