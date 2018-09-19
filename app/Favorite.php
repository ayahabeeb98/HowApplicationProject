<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favouriteVideos';
    protected $fillable = [
      'user_id','video_id'
    ];

    protected $dates = ['created_at','updated_at'];

}
