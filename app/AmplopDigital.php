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
        'payloads'
    ];

    public const PAYMENT_CHANEL = [
        'credit_card', 'mandiri_clickpay', 'cimb_clicks', 'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va', 'bca_va',
        'bni_va', 'other_va', 'gopay', 'indomart', 'danamon_online', 'akulaku'
    ];
    public const EXPIRY_DURATION = 7;
    public const EXPIRY_UNIT = 'days';

    public const CHALLENGE = 'challenge';
    public const SUCCESS = 'success';
    public const SETTLEMENT = 'settlement';
    public const PENDING = 'pending';
    public const DENY = 'deny';
    public const EXPIRE = 'expire';
    public const CANCEL = 'cancel';


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
