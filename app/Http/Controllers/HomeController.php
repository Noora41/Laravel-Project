<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\User;
use App\Post;
use App\Category;
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
        $posts=Post::orderBy('created_at','desc')->paginate(3);
        $recentposts=Post::orderBy('created_at','desc')->paginate(5);
        $featuredpost=Post::orderBy('totallike','desc')->paginate(5);
        $categories=Category::orderBy('category_name','asc')->get();
        return view('home')->with(
            ['posts'=>$post,
            'profile'=>$profile,
            'recentposts'=>$recentposts,
            'posts'=>$posts,
            'featuredpost'=>$featuredpost,
            'categories'=>$categories]);
    }
    public function category($cat){
        $categories=Category::all();
        $posts=DB::table('posts')
                ->join('categories','posts.category_id',"=",'categories.id')
                ->select('posts.*','categories.*')
                ->where(['categories.id'=>$cat])
                ->get();
            
            return view('Categories.category',['categories'=>$categories,'posts'=>$posts]);
    }
    public function search(Request $request){
        $user_id=Auth::user()->id;
        $profile=Profile::find($user_id);
        $keyword=$request->input('search');
        $post=Post::where('title','LIKE','%'.$keyword.'%')->first();
        return view('posts.searchposts',['profile'=>$profile,'post'=>$post]);
    }
}
