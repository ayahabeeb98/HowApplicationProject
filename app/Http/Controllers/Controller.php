<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function userLogout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }

    public function success($data,$status = 200){
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'errors' => 0
        ],$status)->header('Content-Type','application/json');
    }

    public function errors($data,$status=400){
        if($data instanceof MessageBag){
            return response()->json([
                'status' => 'error',
                'data' => $data->first(),
                'errors' => 1
            ],$status)->header('Content-Type','application/json');
        }

    }

    public function uploadImage($image, $dir = 'Image')
    {
        $uploadedImage = $image;
        $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
        $direction = public_path($dir . '/');
        $uploadedImage->move($direction, $imageName);
        return $dir . '/' . $imageName;
    }
}
