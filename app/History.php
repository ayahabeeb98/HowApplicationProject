<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    public $user_id;
    public $video_id;
    protected $fillable = [
            'user_id','video_id',
    ];
    protected $dates = ['created_at','updated_at'];
}
