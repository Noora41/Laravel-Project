<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }
    public function add(){
        return view('dashboard.categoryadd');
    }
    public function added(){
        return view('dashboard.index');
    }
    public function list(){
        $categories=Category::get();
        return view('dashboard.categorylist')->with('categories',$categories);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'category_name'=>'required',
        ]);

        $category=new Category;
        $category->category_name=$request->input('category_name');
        $category->save();

        return redirect('/dashboard/category/add')->with('success','Category Added');
    }
    public function edit($id)
    {
        $category=Category::find($id); 

        //check for correct user
        // if(auth()->user()->id !==$category->user_id){
        //     return redirect('/dashboard/category/add')->with('error','Unauthorized Page');
        // }
        return view('dashboard.edit')->with('category',$category);
    }
    public function update(Request $request)
    {
        $id=$request->input('id');
        $this->validate($request,[
            'category_name'=>'required',
        ]);
    
        $category_update=new Category;
        $category_update->category_name=$request->input('category_name');
        $data=array(
            'category_name' => $category_update->category_name
                );

        Category::where('id',$id)->update($data);
        $category_update->update();

        return redirect('/dashboard/category/add')->with('success','Category Updated');
    }
    public function delete($id)
    {   
        Category::where('id',$id)
        ->delete();

        //check for correct user
        if(auth()->user()->id !==$category->user_id){
            return redirect('/dashboard/category/add')->with('error','Unauthorized Page');
           }
        //$category->delete();
        return redirect('/dashboard/category/add')->with('success','Category Removed');
    }

}
