<?php

namespace App\Http\Controllers\Api;

use App\History;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    /**
     * add new video to history table
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
     * return videos as object from history table
     * @return Controller
     */

    public function showHistory(){
        try{
            $user_id =  Auth::guard('api')->id();
            $user =History::where(['user_id' => $user_id])->firstOrFail();
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

    /**
     * clear all history
     * @return Controller
     */
    public function clearHistory(){
        try{
            $user = Auth::guard('api')->user()->id;
            $user_id = History::where(['user_id' => $user])->firstOrFail();
            $histories = DB::table('history')
                ->where('user_id','=',$user)
                ->delete();
            return parent::success('history deleted successfully');
        }catch (\Exception $exception){
            return parent::errors('This list has no videos.');
        }
    }

}
