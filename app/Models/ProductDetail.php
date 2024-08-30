<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table="product_details";
    protected $fillable=['detail_id','product_id','detail_value'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function detail(){
        return $this->belongsTo(Product::class);
    }
}
