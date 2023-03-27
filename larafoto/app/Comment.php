<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    // many to one
    function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    function image() {
        return $this->belongsTo('App\Image', 'image_id');
    }
}
