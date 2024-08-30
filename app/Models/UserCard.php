<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCard extends Model
{
    use HasFactory;
    protected $table='user_cards';
    protected $fillable=['user_id','card_number','expiry_date'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
