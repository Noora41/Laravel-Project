@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
      <div class="form-group">
          {{Form::label('title','Title')}}
          {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
      </div>  
      <div class="form-group">
            <label for="exampleFormControlSelect1">Category</label>
            <select class="form-control" name="category_id" id="exampleFormControlSelect1">
                <option >Select Option</option>
                @foreach($category->all() as $cat)
                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                @endforeach 
            </select> 
        </div>
      <div class="form-group">
          {{Form::label('ingredients','Ingredients')}}
          {{Form::textArea('ingredients','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Ingredients'])}}
      </div>  
      <div class="form-group">
          {{Form::label('instructions','Instructions')}}
          {{Form::textArea('instructions','',['class'=>'form-control','placeholder'=>'Instructions'])}}
      </div> 
      <div class="form-group">
          {{Form::file('cover_image')}}
      </div>
      {{Form::submit('Submit',['class'=>'btn btn-primary'])}}   
    {!! Form::close() !!} 
@endsection  