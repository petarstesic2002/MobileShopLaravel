<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table='users';
    protected $fillable = ['first_name','last_name','password','phone','role_id','email'];
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function address(){
        return $this->hasMany(Address::class);
    }
    public function user_card(){
        return $this->hasMany(UserCard::class);
    }
    public function orders(){
        return $this->hasMany(OrderSession::class);
    }
}
