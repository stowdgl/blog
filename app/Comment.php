<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function users()
    {
        return $this->hasOne('App\User');
    }
    public function posts()
    {
        return $this->belongsTo('App\Post','post_id');
    }
}
