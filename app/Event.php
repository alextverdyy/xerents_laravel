<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Event extends Model
{

    protected $fillable = ['event_id', 'user_id'];
    protected $table = 'likes';
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes');
    }
}
