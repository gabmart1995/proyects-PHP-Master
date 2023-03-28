<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    // relationship one to many
    function comments() {
        return $this->hasMany('App\Comment')->orderBy('id', 'DESC');
    }

    function likes() {
        return $this->hasMany('App\Like');
    }

    // many to one
    function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
}
