<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;

class LogOutApiController extends Controller
{
    public function ApiLogout(Request $request){
//        Auth::guard('api')->logout();
        $request->user()->token()->revoke();
        return  parent::success('you are logout');
    }
}
