<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'passwordReset';

    protected  $fillable = [
        'email', 'token'
    ];

    protected $dates =  ['created_at','updated_at'];
}
