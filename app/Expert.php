<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $table = 'experts';
    protected $fillable = [
      'userName','email','password','phone','job','description','image'
    ];

    protected $hidden = [
      'remember_token' , 'password'
    ];


}
