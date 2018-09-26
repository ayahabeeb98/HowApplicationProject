<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use SoftDeletes;
    protected $table = 'favouriteVideos';
    protected $fillable = [
      'user_id','video_id'
    ];

    protected $dates = ['created_at','updated_at'];

}
