<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Category;
use App\Like;
use App\Comment;
use Auth;

class PostsController extends Controller
{   
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->paginate(1);
        //$post=Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::where('status','=',1)
        ->get();
        return view('posts.create')->with('category',$category); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_id'=>'required',
            'title'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            //get file name with extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }
        else{
            $fileNameToStore='noimage.jpg';
        }
        //Create Post
        $post=new Post;
        $post->category_id=$request->input('category_id');
        $post->title=$request->input('title');
        $post->instructions=$request->input('instructions');
        $post->ingredients=$request->input('ingredients');
        $post->type=$request->input('type');
        $post->user_id= Auth::user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts=Post::find($id);
        $likePost=Post::find($id);
        $likeCtr=Like::where(['post_id'=>$likePost->id])->count();
        $comments=DB::table('users')
        ->join('comments','users.id','=','comments.user_id')
        ->join('posts','comments.post_id','=','posts.id')
        ->select('users.name','comments.*')
        ->where(['posts.id'=>$id])
        ->get();
    
        return view('posts.show')->with(['post'=>$posts,'likeCtr'=>$likeCtr,'comments'=>$comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);

        $category=Category::where('status','=',1)
        ->get();
        //check for correct user
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }
        return view('posts.edit')->with(['post'=>$post,'category' =>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'category_id'=>'required',
            'title'=>'required',
            'instructions'=>'required',
            'ingredients'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

         //Handle file upload
         if($request->hasFile('cover_image')){
            //get file name with extension
            $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get just filename
            $filename=pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get just extension
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload image
            $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        } else{
            $fileNameToStore='noimage.jpg';
        }
        //Create Post
        $post=Post::find($id);
        $post->category_id=$request->input('category_id');
        $post->title=$request->input('title');
        $post->instructions=$request->input('instructions');
        $post->ingredients=$request->input('ingredients');
        $post->type=$request->input('type');
        if($request->hasFile('cover_image')){
            $post->cover_image=$fileNameToStore;
        } 
        $post->save();
        return redirect('/posts')->with('success','Post Updated');
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);

        //check for correct user
        if(auth()->user()->id !==$post->user_id){
         return redirect('/posts')->with('error','Unauthorized Page');
        }
        if($post->cover_image!='noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
    public function like($id){
        $loggedin_user=Auth::user()->id;
        $like_user=Like::where(['user_id'=>$loggedin_user,'post_id'=>$id])->first();
        if(empty($like_user->user_id)){
            $post=Post::find($id);
            //like update with +1
            $totallike=$post->totallike;
            $newlike=$totallike+1;
            $postforlike=new Post;
            $postforlike->totallike=$newlike;
            $data=array(
                'totallike' => $postforlike->totallike 
                    );
    
            Post::where('id',$id)->update($data);
            $postforlike->update();

            $user_id=Auth::user()->id;
            $email=Auth::user()->email;
            $post_id=$id;

            $like=new Like;
            $like->user_id=$user_id;
            $like->email=$email;
            $like->post_id=$id;
            $like->save();
            return redirect("/posts/{$id}");
        }
        else{
            return redirect("/posts/{$id}");
        }
    }
    public function comment(Request $request,$post_id){
        $this->validate($request,[
            'comment'=>'required'
        ]);
        $comment=new Comment;
        $comment->user_id=Auth::user()->id;
        $comment->post_id=$post_id;
        $comment->comment=$request->input('comment');
        $comment->save();
        return redirect("/posts/{$post_id}")->with('success','Comment Added Successfully'); 
    }
}
