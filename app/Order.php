<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_code',
        'user_id',
        'bride_id',
        'product_id', 
        'voucher_id',
        'desc_id',
        'price_total',
        'payment_method',
        'payment_status',
        'status_order'
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
