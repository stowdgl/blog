<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function categories(){
        return $this->belongsToMany('App\Category');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
