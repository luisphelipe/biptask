<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'user_id', 'name', 'body', 'link'
    ];

    protected $hidden = [
        'user'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
