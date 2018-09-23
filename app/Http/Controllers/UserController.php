<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){

        $users = User::where([]);
        if ($request->has('UserName')){
            $users = $users->where('UserName','like','%'.$request->input('UserName').'%');
        }
        if ($request->has('email')){
            $users = $users->where('email','like','%'.$request->input('email').'%');
        }
        if ($request->has('visaCard')){
            $users = $users->where('visaCard','like','%'.$request->input('visaCard').'%');
        };

        $users = $users->Paginate(10);
        return view('user.index',compact('users'));
    }
}
