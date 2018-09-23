<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $table = 'videos';
    protected $fillable = [
        'name','image','url','video_id','category_id'
    ];
    protected $dates = ['created_at','updated_at'];

    public function Histories(){
        return $this->hasMany(History::class,'video_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
