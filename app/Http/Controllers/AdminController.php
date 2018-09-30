<?php

namespace App\Http\Controllers;

use App\Admain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{


    public function show($id){
        try{
            $admin = Admain::findOrFail($id);
            return view('Admin.profile',compact('admin'));
        }catch (ModelNotFoundException $modelNotFoundException){
            return redirect()->back()->with('error','Admin is not found');
        }
    }


    public function update(Request $request,$id){
        try{
            $admin = Admain::findOrFail($id);
            $request->validate($this->rules($admin->id),$this->messages());
            if ($request->hasFile('image')) {
                if (File::exists(public_path($admin->image))) {
                    File::delete(public_path($admin->image));
                }
                $admin->image = parent::uploadImage($request->file('image'));
            }
            $admin->fill($request->all());
            $admin->update();
            return redirect()->route('admin.profile',['id' => Auth::user()->id])
                ->with('success','your profile has been updated successfully');

        }catch (ModelNotFoundException $modelNotFoundException){
            return redirect()->back()->with('error','not found');
        }
    }

    public function rules($id){
        return  [
          'userName' => 'required|unique:Admins,userName,'.$id,
          'email' => 'required|E-Mail|unique:Admins,email,'.$id,
          'image' => 'mimes:jpeg,bmp,png,jpg'
        ];
    }

    public function messages(){
        return [
          'userName.required' => 'Admin name is required',
          'email.required' => 'Email is required',
          'email.E-Mail' => 'invalid email format',
          'email.unique'=>'Email should be unique',
          'Image.mimes' => 'invalid image',
        ];
    }
}
