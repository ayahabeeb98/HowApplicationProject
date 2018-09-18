<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admain extends Model
{
    protected  $table = 'admins';
    protected $fillable = [
        'userName','password','email','image'
    ];

    protected $hidden = [
      'password' ,'remember_token'
    ];
}

