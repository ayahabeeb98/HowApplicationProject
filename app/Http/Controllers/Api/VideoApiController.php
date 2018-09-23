<?php

namespace App\Http\Controllers\Api;

use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class VideoApiController extends Controller
{
    /**
     * Show all videos and show videos according to search result
     *
     * @return array of objects
     * @param  Request $request
     */
    public function index(Request $request)
    {
        $videos = DB::table('videos');
        if($request->has('problem')) {
                DB::table('search')->insert([
                    'content' => $request['problem'],
                    'user_id' => Auth::user()->id
                ]);

                $searchArray = explode(' ', $request['problem']);
                foreach ($searchArray as $item) {
                    $videos=$videos
                        ->join('categories', 'videos.category_id', '=', 'categories.id')
                        ->where('videos.name', 'like','%'.$item.'%')
                        ->orWhere('categories.name', 'like', '%'.$item.'%')
                        ->select('videos.*','categories.name AS category_name','categories.id As category_id',
                        DB::raw("CONCAT('videos.image',URL::to('/').'videos.image') as 'video_image'")
                        );
                }
            }else{

            $videos=$videos
                ->select('videos.*',
                    DB::raw("CONCAT('videos.image',URL::to('/').'videos.image') as 'video_image'"));
        }
            return parent::success($videos->paginate($request->input('per_page', 10)));
    }
    /**
     * Show specific video according to id
     *
     * @return object
     * @param id
     */
    public function show($id)
    {
        try{
            $video = Video::findOrFail($id);
            $video['image']=URL::to('/').$video['image'];
            return parent::success($video);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::error('video not found');
        }
    }

}
