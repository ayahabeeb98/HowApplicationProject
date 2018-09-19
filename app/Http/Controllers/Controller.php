<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
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
}
