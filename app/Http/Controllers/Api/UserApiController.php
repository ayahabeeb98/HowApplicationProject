<?php

namespace App\Http\Controllers\Api;

use App\History;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            //using query Query Builder
//            DB::table('history')->insert([
//                'user_id' =>  Auth::guard('api')->id(),
//                'video_id' => $video_id
//            ]);

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

    public function showHistory($user_id){
        try{
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
        $video = DB::table('history')
            ->select('video_id',DB::raw('count(*) as total'))
            ->groupBy('video_id')
            ->orderBy('total','desc')
            ->get();

        return parent::success($video);
    }

}
