<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Profile;
use Auth;

class ProfileController extends Controller
{   
    public function index(){

       return view('profiles.index');
    }

    public function profile(){

        return view('profiles.profile');
    }

    public function addProfile(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'designation'=>'required',
            'profile_pic'=>'required'
        ]);
       $profiles=new Profile;
       $profiles->name=$request->input('name');
       $profiles->user_id=Auth::user()->id;
       $profiles->designation=$request->input('designation');
       if(Input::hasFile('profile_pic')){
           $file=Input::file('profile_pic');
           $file->move(public_path().'/upload_media/',$file->getClientOriginalName());
           $url=URL::to("/").'/upload_media/'.$file->getClientOriginalName();
       }
       else{
           $file='noimage.jpg';
       }
       $profiles->profile_pic=$url;
       $profiles->save();
       return redirect('/profile')->with('success','Profile Added Successfully'); 
    }

    public function edit($id){

        $profiles=Profile::find($id);
        return view('profiles.edit')->with('profiles',$profiles); 
    }

    public function update(Request $request){
        $id=$request->input('id');
        $this->validate($request,[
          'profile_pic'=>'required' 
        ]);
        
        $profile_update=new Profile;
        $profile_update->user_id=Auth::user()->id;
        if(Input::hasFile('profile_pic')){
            $file=Input::file('profile_pic');
            $file->move(public_path().'/upload_media/',$file->getClientOriginalName());
            $url=URL::to("/").'/upload_media/'.$file->getClientOriginalName();
        }
        else{
            $file='noimage.jpg';
        }
        $data=array(
            'profile_pic' => $profile_update->profile_pic
                );
        $profile_update->profile_pic=$url;
        Profile::where('id',$id)->update($data);
        $profile_update->update();
        return redirect('/updateProfile')->with('success','Profile Updated Successfully');
    }
}
