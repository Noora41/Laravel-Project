@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        @if (session('status'))
          <div class="alert alert-success"> 
              {{ session('status') }}
          </div>
        @endif  
      <div class="card">
        <div class="card-header text-center">Post View</div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              @if($post->type==2)
                    <h3 style="color:#000;">{{$post->title}}</h3>
                    <br>
                    <img width="70%;"src="/storage/cover_images/{{$post->cover_image}}" alt="">
                    <br><br>
                    <h4 style="color:#000;">Ingredients:</h4>
                    <h4 style="color:#000;">{!!$post->ingredients!!}</h4> 
                    <br>
                    <h4 style="color:#000;">Instructions:</h4>
                    <h4 style="color:#000;">{!!$post->instructions!!}</h4> 
                    <br>
                    <ul class="nav nav-pills">
                        <li role="presentation">
                            <a href="/posts/{{$post->id}}">
                                <button type="button" class="btn">Read</button>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="/posts/{{$post->id}}/edit">
                                <button type="button" class="btn">Edit</button>
                            </a>
                        </li>
                        <li role="presentation">@if(Auth::user()->id==$post->user_id) {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!} {{Form::hidden('_method','DELETE')}} {{Form::submit('Delete',['class'=>'btn'])}} {!!Form::close()!!} @endif</li>
                        </ul>
                        <hr>
              @elseif($post->type==1)
                  <h3 style="color:#000;">{{$post->title}}</h3>
                  <br>
                  <img width="70%;"src="/storage/cover_images/{{$post->cover_image}}" alt="">
                  <br><br>
                  <h4 style="color:#000;">{!!$post->instructions!!}</h4> 
                  <br>
                  <ul class="nav nav-pills">
                    <li role="presentation">
                        <a href="/posts/{{$post->id}}">
                            <button type="button" class="btn">Read</button>
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="/posts/{{$post->id}}/edit">
                            <button type="button" class="btn">Edit</button>
                        </a>
                    </li>
                    <li role="presentation">@if(Auth::user()->id==$post->user_id) {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!} {{Form::hidden('_method','DELETE')}} {{Form::submit('Delete',['class'=>'btn'])}} {!!Form::close()!!} @endif</li>
                  </ul>
                   <hr>
              @endif                                                        
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection