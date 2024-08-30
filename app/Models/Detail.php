<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table='details';
    public function products(){
        return $this->belongsToMany(Product::class,'product_details')->withPivot('product_id','detail_value','id');
    }
    public function values(){
        return $this->hasMany(ProductDetail::class);
    }
}
