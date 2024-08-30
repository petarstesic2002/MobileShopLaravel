<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSession extends Model
{
    use HasFactory;
    protected $table="order_sessions";
    protected $fillable=['user_id','total','card_id'];
    public function products(){
        return $this->belongsToMany(Product::class,'order_items','order_id','product_id')->withPivot(['product_id','price_id','quantity']);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
