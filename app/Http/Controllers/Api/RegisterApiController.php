<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\User;


class RegisterApiController extends Controller
{
    public function Registration(Request $request){
        $validation = Validator::make($request->all(),$this->rules());
        if ($validation->fails()) {
            return parent::errors($validation->errors());
        }
        $user = new User();
        $user->fill($request->all());
        $user->image = parent::uploadImage($request->file('image'));
        $request['password'] = Hash::make($request->input('password'));
        $user->save();
        return parent::success($user);
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
            'password' => 'required|string|min:6',
        ];
        return $rules;
    }

}
