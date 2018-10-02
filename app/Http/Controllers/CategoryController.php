<?php

namespace App\Http\Controllers;
use App\Category;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
   public function create(){
       return view('categoryCreate');
   }

    public  function  store(Request $request){

        $this->validate($request,$this->rules(),$this->messages());
        $image = $request->file('image');
        $imageName = time(). "." .$image->getClientOriginalExtension();
        $direction = public_path('image/');
        $image->move($direction,$imageName);
        $Category = new Category();
        $Category->fill($request->all());
        $Category->image = 'image/' . $imageName;
        $Category->save();
        return redirect()->back()->with('success', 'Category has been saved successfully');

    }

    public function index(Request $request){
        $category = Category::where([]);
        if ($request->has('name'))
            $category = $category->where('name', 'like', '%' . $request->input('name') . '%');
        $data['category'] = $category->paginate(10);
        return view('Cindex', $data);
    }

    public function destroy($id){

        try {
            $category = category::findOrFail($id);
            $videos = Video::where(['category_id' => $id])->count();
            if ($videos == 0){
                $category->delete();
                return redirect()->route('category.index')->with('success', 'Category deleted successfully');
            }else{
                return redirect()->route('category.index')->with('error','Category has videos');
            }
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('category.index')->with('error','Category does not found');
        }

    }

    public function edit($id){
        try {
            $category = Category::findOrFail($id);
            return view('categoryEdit', compact('category'));
        } catch (\Exception $exception) {
            return redirect()->route('category.index');

        }
    }

    public function update(Request $request,$id){

        try{
            $category=Category::findOrFail($id);
        }catch (ModelNotFoundException $exception) {
            return redirect()->route('category.index');
        }

        $this->validate($request,$this->rules($category->id), $this->messages());

        if ($request->hasFile('image')) {
            if (File::exists(public_path($category->image))) {
                File::delete(public_path($category->image));
            }
            $request['image']  = parent::uploadImage($request->file('image'));
        }

        $category->fill($request->all());
        $category->update();
        return redirect()->route('category.index');


    }


    public function rules(){
       return[
           'name' => 'required',
           'image' =>'required'
       ];
    }

    public function messages(){

       return[
           'name.required'=>'This Feild is Required',
           'image.required'=>'This Feild is Required'
       ];
    }



}
