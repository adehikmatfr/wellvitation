<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'web_name',
        'event_name',
        'event_desc',
        'akad_place',
        'akad_address',
        'akad_date',
        'marriage_place',
        'marriage_address',
        'marriage_date',
        'description',
        'message',
        'youtube_link',
        'asset_link'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [];
}
