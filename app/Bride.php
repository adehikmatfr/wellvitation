<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bride extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bridegroom_name',
        'bridegroom_religion',
        'bridegroom_guardian',
        'bridegroom_bio',
        'bridegroom_social',
        'bride_name',
        'bride_religion',
        'bride_guardian',
        'bride_bio',
        'bride_social'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
