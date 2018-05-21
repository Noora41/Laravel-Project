@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <div class="container">
            <ul class="nav nav-tabs">
              <li class="active col-lg-6 text-center " ><a  data-toggle="tab" href="#home">Blogs</a></li>
              <li class="col-lg-6 text-center" ><a   data-toggle="tab" href="#menu1">Recipes</a></li>
            </ul>
          
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">
                  {{-- blog --}}
                    {!! Form::open(['action' => 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('title','Title')}}
                        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
                    </div>  
                    <div class="form-group">
                          <label for="category_id">Category</label>
                          <select class="form-control" name="category_id" id="category_id">
                              <option >Select Option</option>
                              @foreach($category->all() as $cat)
                              <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                              @endforeach 
                          </select> 
                      </div> 
    
                    <div class="form-group">
                          {{Form::label('instructions','Body')}}
                          {{Form::textArea('instructions','',['class'=>'form-control','placeholder'=>'Body'])}}
                      </div>  
                    <div class="form-group">
                        {{Form::file('cover_image')}}
                    </div>
                    <input type="hidden" name="type" id="1" value="1">
                    <input type="hidden" name="ingredients" value="">

                    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}   
                  {!! Form::close() !!} 
              </div>
              <div id="menu1" class="tab-pane fade">
                  {{-- recipe --}}

                    {!! Form::open(['action' => 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('title','Title')}}
                        {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
                    </div>  
                    <div class="form-group">
                          <label for="category_id">Category</label>
                          <select class="form-control" name="category_id" id="category_id">
                              <option >Select Option</option>
                              @foreach($category->all() as $cat)
                              <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                              @endforeach 
                          </select> 
                      </div> 
                      <div class="form-group">
                            {{Form::label('ingredients','Ingredients')}}
                            {{Form::textArea('ingredients','',['class'=>'form-control','placeholder'=>'Ingredients'])}}
                        </div>  
    
                    <div class="form-group">
                          {{Form::label('instructions','Instructions')}}
                          {{Form::textArea('instructions','',['class'=>'form-control','placeholder'=>'Instructions'])}}
                      </div>  
                    <div class="form-group">
                        {{Form::file('cover_image')}}
                    </div>
                    <input type="hidden" name="type" id="2" value="2">
                    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}   
                  {!! Form::close() !!} 

            </div>
            </div>
          </div>
@endsection  