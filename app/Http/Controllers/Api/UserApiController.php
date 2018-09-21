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

    public function Register(Request $request){
        $validation = Validator::make($request->all(),$this->rules());
        if ($validation->fails()) {
            return parent::errors($validation->errors());
        }
        $user = new User();
        $user->image = parent::uploadImage($request->file('image'));
        $request['password'] = Hash::make($request->input('password'));
        $user->fill($request->all());
        $user->save();
        return parent::success($user);
    }


    public function ApiLogout(Request $request){
        dd($request->user()->token()->revoke());
        Auth::guard('api')->logout();
        return  redirect()->route('recommended.videos');
    }

    private function rules(){
        $rules = [
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'UserName' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:9|max:20|unique:users',
            'visaCard' => 'required|string|min:7|max:19|unique:users',
            'image' => 'required|image',
            'password' => 'required|string|min:6|confirmed',
        ];
        return $rules;
    }

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
        $video = DB::table('history')
            ->select('video_id',DB::raw('count(*) as total'))
            ->groupBy('video_id')
            ->orderBy('total','desc')
            ->get();

        return parent::success($video);
    }

}
