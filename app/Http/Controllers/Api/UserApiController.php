<?php

namespace App\Http\Controllers\Api;

use App\Favorite;
use App\History;
use App\User;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function show()
    {
        try{
            $user = User::findOrFail(Auth::id());
            $user['image'] = URL::to('/').$user->image;
            return parent::success($user);
        }catch (ModelNotFoundException $exception){
            return parent::errors('User Not Found');
        }
    }

    /**
     *
     * @param $video_id
     * @return string
     *
     */
    public function history($video_id){
        try{
            $video = Video::findOrFail($video_id);
            $history = new History();
            $history->user_id = Auth::guard('api')->id();
            $history->video_id = $video_id;
            $history->save();

            return parent::success($history);

        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors('Video not found');
        }
    }

    /**
     * return videos as object
     * @param $user_id
     * @return Controller
     */

    public function showHistory(){
        try{
            $user_id =  Auth::guard('api')->id();
            $user = History::findOrFail($user_id);
            $videos = DB::table('history')
                ->join('videos','videos.id','=','history.video_id')
                ->select('videos.*')
                ->where('user_id','=',$user_id)->get();

//        $videos = $videos->paginate(15);
            return parent::success($videos);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors('user not found');
        }
    }

    public function addFavorite($video_id){//done
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
