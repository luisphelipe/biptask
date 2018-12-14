<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'user_id', 'body'
    ];

    protected $hidden = [
        'user'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}

