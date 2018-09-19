<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
      'user_id','video_id','comment'
    ];

    protected $dates = ['created_at','updated_at'];
}
