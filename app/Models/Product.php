<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Post
 *
 * @mixin Eloquent
 */

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable=['name','description','image','category_id','brand_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function newestPrice()
    {
        return $this->hasMany(Price::class)->latest('created_at');
    }
    public function details()
    {
        return $this->belongsToMany(Detail::class,'product_details')->withPivot(['detail_value','product_id','detail_id']);
    }
    public static function hasDetails($id){
        return ProductDetail::with('detail')->where('product_id','=',$id)->get();
    }
    public static function notDetails($id){
        return Detail::whereDoesntHave('values',function($q) use($id){
            $q->where('product_id','=', $id);
        })->get();
    }
    public function orders()
    {
        return $this->belongsToMany(OrderSession::class,'order_items')->withPivot(['product_id','price_id','quantity']);
    }
}
