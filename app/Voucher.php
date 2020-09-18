<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_voucher',
        'code_voucher',
        'discount',
        'mix_discount',
        'mix_usage',
        'count',
        'status',
        'expired_date'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
