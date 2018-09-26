<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use SoftDeletes;
    protected $table = 'history';
    protected $fillable = [
            'user_id','video_id',
    ];
    protected $dates = ['created_at','updated_at'];

    public function video(){
        return $this->belongsTo(Video::class,'video_id','id');
    }
}
