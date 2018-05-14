<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\User;
use App\Post;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user_id=Auth::user()->id;
        $profile=DB::table('users')
                 ->join('profiles','users.id',"=",'profiles.user_id')
                 ->select('users.*','profiles.*')
                 ->where(['profiles.user_id'=>$user_id])
                 ->first();      
        $post=Post::where('user_id','=',$user_id)
        //->where('status','=',1)
        ->get(); 
        $posts=Post::orderBy('created_at','desc')->paginate(1);
        $recentposts=Post::orderBy('created_at','desc')->paginate(5);
        $featuredpost=Post::orderBy('totallike','desc')->paginate(5);
        return view('home')->with(
            ['posts'=>$post,
            'profile'=>$profile,
            'recentposts'=>$recentposts,
            'posts'=>$posts,
            'featuredpost'=>$featuredpost]);
    }
}
