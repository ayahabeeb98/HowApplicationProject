<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

const BOOK_PAGINATION=10;

class VideoController extends Controller{
    public function index(Request $request,$num=BOOK_PAGINATION){
        $videos=Video::where([]);
        if($request->has('name'))
            $videos=$videos->where('name','like','%'.$request->input('name').'%');
        if($request->has('url'))
            $videos=$videos->where('url','like','%'.$request->input('url').'%');
        if($request->has('category_id'))
            $videos=$videos->where('category_id','like','%'.$request->input('category_id').'%');
        $videos=$videos->paginate($num);
        return view('Video.index',compact('videos'));
    }
    public function create(){
        return view('Video.create');
    }
    public function store(Request $request){
        $request->validate($this->rules(),$this->messages());
        $uploadedImage=parent::uploadImage($request->file('video_image'));
        $video=new Video();
        $start = strrpos($request['url'], '=') + 1;
        $video->video_id=substr($request['url'], $start);
        $video->image=$uploadedImage;
        $video->fill($request->all());
        $video->save();
        return redirect()->back()->with('success','Video has been added successfully');
    }
    public function destroy($id)
    {
        try {
            $video = Video::findOrFail($id);
            $video->delete();
            return redirect()->back()->with('success', 'Video has been deleted successfully');
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Video is not found');
        }
    }
    public function edit($id){
        try {
            $video = Video::findOrFail($id);
            return view('Video.edit', compact('video'));
        } catch (\Exception $exception) {
            return redirect()->route('video.index')->with('error', 'Video is not found');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $video = Video::findOrFail($id);
        } catch (\Exception $exception) {
            return redirect()->route('video.edit')->with('error', 'Video is not found');
        }
        $request->validate($this->rules($video->id), $this->messages());
        if ($request->hasFile('video_image')) {
            if (File::exists(public_path($video->image))) {
                File::delete(public_path($video->image));
            }
            $video->image = parent::uploadImage($request->file('video'));

        }
        $video->fill($request->all());
        $video->update();
        return redirect()->route('video.index')
            ->with('success',  'Video has been updated successfully');

    }
    private function rules($id = null){
        $rules=[
            'name'=>'required',
            'category_id'=>'required',
            'url'=>'required',
            'video_image'=>'mimes:jpeg,bmp,png,jpg',
        ];
        if ($id) {
            $rules['url'] = 'required|unique:videos,url,' . $id;
        } else {
            $rules['url'] = 'required|unique:videos,url';
            $rules['video_image'] = 'required|mimes:jpeg,bmp,png,jpg';
        }
        return $rules;
    }
    public function messages(){
        return[
            'name.required' => 'name is required',
            'url.required' => 'url is required',
            'category_id.required' => 'category_id is required',
            'video_image.required' => 'image is required',
            'video_image.mimes' => 'invalid image'        ];

    }}
