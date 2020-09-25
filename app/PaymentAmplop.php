<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAmplop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amplop_id',
        'transaction_time',
        'transaction_status',
        'transaction_id',
        'status_message',
        'status_code',
        'signature_key',
        'payment_type',
        'merchant_id',
        'masked_card',
        'gross_amount',
        'fraud_status',
        'eci',
        'currency',
        'channel_response_message',
        'channel_response_code',
        'card_type',
        'bank'
    ];

    public const PAYMENT_CHANEL = [
        'mandiri_clickpay', 'cimb_clicks', 'bca_klikbca', 'bca_klikpay', 'bri_epay', 'echannel', 'permata_va', 'bca_va',
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
    protected $hidden = [
        'channel_response_message',
        'channel_response_code',
        'card_type',
        'bank',
        'masked_card',
        'eci'
    ];
}
