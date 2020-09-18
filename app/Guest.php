<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invitation_code',
        'order_id',
        'name',
        'gender',
        'address',
        'total_guest',
        'email',
        'phone',
        'status',
        'type',
        'is_online',
        'greetings',
        'kecamatan',
        'kota'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
