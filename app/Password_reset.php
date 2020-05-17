<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'username', 'key','answer'
    ];

    protected $hidden=[
        'key','answer'
    ];
    
}
