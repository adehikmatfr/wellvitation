<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'nama_kebutuhan',
        'jumlah',
        'harga',
        'total',
        'vendor',
        'contact_person',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
