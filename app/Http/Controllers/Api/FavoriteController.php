<?php

namespace App\Http\Controllers\Api;

use App\Favorite;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{

    public function addFavorite($video_id){
        try{
            $video = Video::findOrFail($video_id);
            $favorite = new Favorite();
            $favorite->video_id = $video_id;
            $favorite->user_id =Auth::guard('api')->user()->id;
            $favorite->save();
            return parent::success($favorite);
        }catch (ModelNotFoundException $modeuserlNotFoundException){
            return parent::errors(' Something went wrong');
        }
    }

    public function deleteFavorite($v_id){//done
        try{
            $favorite = Favorite::findOrFail($v_id);
            $favorite->delete();
            return parent::success($favorite);
        }catch (ModelNotFoundException $exception){
            return parent::errors('Video not found');
        }
    }

    public function showFavorite(){
        try{
            $user_id = Auth::guard('api')->id();
            $user = Favorite::findOrFail($user_id);
            $favorite = DB::table('favouritevideos')
                ->join('videos','videos.id','=','favouritevideos.video_id')
                ->select('videos.*')
                ->where('user_id','=',$user_id)->get();
            return parent::success($favorite);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors('there is no video');
        }
    }



}
