<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table='user_address';
    protected $fillable=['user_id','address_line','postal_code','city','country'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
