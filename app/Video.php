<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;
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

    public function getImage()
    {
        if (!$this->image)
            return asset('no_image.png');
        return asset($this->image);
    }
}
