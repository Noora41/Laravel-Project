<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;

class DashboardsController extends Controller
{
    public function dashboard(){
        $user_id=Auth::user()->id;
        $post=Post::where('user_id','=',$user_id)
        ->get();
        return view('pages.dashboard',['posts' => $post]);
    }
}
