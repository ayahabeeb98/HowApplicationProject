<?php

namespace App\Http\Controllers\Api;

use App\History;
use App\User;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
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
            return parent::errors('Error');
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

    public function recommendedVideos(){
        $video = Video::withCount('Histories')
            ->has('Histories','>',0)
            ->orderBy('histories_count','desc')
             ->get();
        return parent::success($video);
    }

}
