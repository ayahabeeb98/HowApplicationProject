<?php

namespace App\Http\Controllers\Api;

use App\Search;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Show all user searches
     *
     * @return array of objects
     *
     */
    public function index(){
       $searches=Search::all()->where('user_id','=',Auth::id());
       return parent::success($searches);
    }
}
