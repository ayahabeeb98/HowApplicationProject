<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class LogOutApiController extends Controller
{
    public function ApiLogout(){
        Auth::guard('api')->logout();
        return  parent::success('you are logout');
    }
}
