<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    // many to one
    function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    function image() {
        return $this->belongsTo('App\Image', 'image_id');
    }
}
