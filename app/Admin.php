<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable=['user_id','address', 'balance', 'wallet', 'ewallet_recharge', 'coupon_price', 'point', 'fb', 'twitter', 'insta', 'youtube', 'admin_status'];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
