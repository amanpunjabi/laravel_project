<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    protected $table = 'orders';

    protected $fillable = [
        'order_number', 'user_id', 'status','subtotal','tax','discount', 'grand_total', 'item_count', 'payment_status', 'payment_method',
        'firstname', 'lastname', 'address', 'city', 'state', 'pincode', 'phone', 'notes','coupon'
    ];

    public function user() {

        return $this->belongsTo('App\User', 'user_id');
    }

    public function items() {
        return $this->hasMany('App\OrderItem');
    }

    public function countCouponUsed($code) {
        $count = $this::get();
        dd($count);
    }
}
