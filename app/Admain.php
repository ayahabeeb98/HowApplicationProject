<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Auth;

class Admain extends Auth
{
    protected  $table = 'admins';
    protected $fillable = [
        'userName','password','email','image'
    ];

    protected $hidden = [
      'password' ,'remember_token'
    ];

    protected $dates = ['created_at','updated_at'];

    public function getImage()
    {
        if (!$this->image)
            return asset('no_image.png');
        return asset($this->image);
    }
}

