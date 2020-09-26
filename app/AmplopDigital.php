<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmplopDigital extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trx_id',
        'user_id',
        'order_id',
        'nominal',
        'payment_method',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
