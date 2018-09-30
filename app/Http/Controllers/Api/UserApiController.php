<?php

namespace App\Http\Controllers\Api;

use App\Favorite;
use App\History;
use App\User;
use App\Video;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    /**
     * show all user data
     * @return Controller
     */
    public function show()
    {
        try{
            $user = User::findOrFail(Auth::id());
            $user['image'] = URL::to('/').$user->image;
            return parent::success($user);
        }catch (ModelNotFoundException $exception){
            return parent::errors('User Not Found');
        }
    }

    public function updateName(Request $request){
        try{
            $user = User::findOrFail(Auth::id());
            $id = Auth::id();
            $validator = Validator::make($request->all(),
                ['UserName' => 'required|string|max:255|unique:users,userName,'.$id],
                [
                    'UserName.required' => 'userName is required',
                    'UserName.unique' => 'This username is already in use'
                ]
            );
            if ($validator->fails()){
                return parent::errors($validator->errors());
            }
            $user->fill($request->all());
            $user->update();;
            return parent::success($user->UerName);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors('user not found');
        }
    }

    public function updatePassword(Request $request){
        try{
            $user = User::findOrFail(Auth::id());
            $id = Auth::id();
            $currentPassword = User::where(['id' => $id])->value('password');
            $newPassword = Hash::make($request->input('current_password'));
            if ($newPassword == $currentPassword){
                $validator = Validator::make($request->all(),
                    ['password' => 'required|string|min:6|confirm'],
                    [
                        'password.required' => 'Password is required',
                    ]
                );
                if ($validator->fails()){
                    return parent::errors($validator->errors());
                }
                $user->fill(Hash::make($request->input('password')));
                $user->update();
            }else{
                return parent::errors('password does not match');
            }
            return parent::success($user->password);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors('user not Found');
        }
    }

    public function updateEmail(Request $request){
        try{
            $user = User::findOrFail(Auth::id());
            $id = Auth::id();
            $validator = Validator::make($request->all(),
                ['email' => 'required|email|unique:users,email,'.$id],
                [
                    'email.required' => 'Email is required',
                    'email.email' => 'invalid Email format',
                    'email.unique' => 'This email is already in use'
                ]
            );
            if ($validator->fails()){
                return parent::errors($validator->errors());
            }
            $user->fill($request->all());
            $user->update();
            return parent::success($user->email);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors('user not found');
        }
    }

    public function updatePhone(Request $request){
        try{
            $user = User::findOrFail(Auth::id());
            $id = Auth::id();
            $validator = Validator::make($request->all(),
                ['phone' => 'required|string|min:9|max:20|unique:users,phone,'.$id],
                [
                    'phone.required' => 'phone number is required',
                    'phone.unique' => 'This phone number is already in use'
                ]
            );
            if ($validator->fails()){
                return parent::errors($validator->errors());
            }
            $user->fill($request->all());
            $user->update();;
            return parent::success($user->phone);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::errors('user not found');
        }
    }

    public function updateImage(Request $request){
        $user = User::findOrFail(Auth::id());
        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->Image))) {
                File::delete(public_path($user->Image));
            }
            $user->image = parent::uploadImage($request->file('image'));
        }

        return parent::success(URL::to('/').$user->image);

    }

}
