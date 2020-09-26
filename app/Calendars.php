<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendars extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'title',
        'start',
        'end',
        'allday',
        'colors'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
