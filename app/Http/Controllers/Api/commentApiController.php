<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class commentApiController extends Controller
{

    public function addComment(Request $request,$v_id){//done
        try{
            $comment = new Comment();
            $video = Video::findOrFail($v_id);
            $validator = Validator::make($request->all(),['comment'=>"required"]);
            $comment->comment = $request['comment'];
            $comment->video_id = $v_id;
            $comment->user_id =Auth::guard('api')->user()->id;
            $comment->save();
            return parent::success($comment);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors(' Something went wrong');
        }

    }

    public function showComment($video_id){//done
        try{
            $video = Comment::findOrFail($video_id);
            $comment = DB::table('comments')->where('video_id','=',$video_id)->get();
            return parent::success($comment);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors('videos not found');
        }

    }

    public function updateComment(Request $request ,$comment_id){//done
            $comment = Comment::findOrFail($comment_id);
            $user = Auth::guard('api')->user()->id;
            $UserComment = Comment::where(['user_id' => $user , 'id' => $comment_id])->first();
            if(!$UserComment)
                return parent::errors('comment not found');
            $comment->fill($request->all());
            $comment->update();
            return parent::success('Comment updated successfully');
    }


    public function deleteComment($comment_id){
       try{
        $user = Auth::guard('api')->user()->id;
        $comment = Comment::findOrFail($comment_id);
        $comment = Comment::where(['user_id' => $user , 'id' => $comment_id])->first();
        if(!$comment)
            return parent::errors('comment not found');
        $comment->delete();
        return parent::success($comment);
        }catch (ModelNotFoundException $modelNotFoundException){
           return parent::errors('comment not found');
       }
    }

    function rules(){
        [
            'comment'=>'required',
        ];
    }
}
