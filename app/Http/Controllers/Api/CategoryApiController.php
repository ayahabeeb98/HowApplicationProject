<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class CategoryApiController extends Controller
{
    public function index(Request $request){
        $categories=DB::table('categories')
            ->select('categories.*',
                DB::raw("CONCAT('".URL::to('/')."',categories.image) as 'image'"));
        return parent::success($categories->paginate($request->input('per_page', 10)));

    }
    public function show($id)
    {
        try{
            $category = Category::findOrFail($id);
            $category['image']=URL::to('/').$category['image'];
            return parent::success($category);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return parent::errors('Category not found');
        }
    }
    public function getVideos($id){
      try{
        $category = Category::findOrFail($id);
        $videos = $category->videos;
//        dd($videos);
//        foreach ($videos as $video)
//            $videos->image=URL::to('/').$videos->image;
        $video = Video::where(['category_id' => $id])->count();
        if ($video == 0)
            return parent::success('There is no video in this category');
        return parent::success($videos);
      }catch (ModelNotFoundException $modelNotFoundException){
          return parent::errors('Category not found');
      }
    }
}
