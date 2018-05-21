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
                    <img width="70%;"src="/storage/cover_images/{{$post->cover_image}}" alt="">
                    <br><br>
                    <h4 style="color:#000;">Ingredients:</h4>
                    <h4 style="color:#000;">{!!$post->ingredients!!}</h4> 
                    <br>
                    <h4 style="color:#000;">Instructions:</h4>
                    <h4 style="color:#000;">{!!$post->instructions!!}</h4> 
                    <ul class="nav nav-pills">
                    <li role="presentation">
                        <a href='{{url("/like/{$post->id}")}}'>
                          <button type="button" class="btn">Like({{$likeCtr}})</button>
                        </a>    
                    </li> 
                    <li role="presentation">
                        <a href='{{url("/comment/{$post->id}")}}'>
                          <button type="button" class="btn">Comment</button>
                        </a>    
                    </li>    
                </ul> 
                <br>
                <form method="POST" action='{{ url("/comment/{$post->id}") }}'>
                  @csrf
                    <div class="form-group">
                      <textarea name="comment" id="comment" rows="3" class="form-control" required autofocus></textarea>  
                    </div> 
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-lg btn-block">Comment</button>
                    </div>
                </form> 
              @elseif($post->type==1)
                  <h3 style="color:#000;">{{$post->title}}</h3>
                  <img width="70%;"src="/storage/cover_images/{{$post->cover_image}}" alt="">
                  <br><br>
                  <h4 style="color:#000;">{!!$post->instructions!!}</h4> 
                  <ul class="nav nav-pills">
                  <li role="presentation">
                      <a href='{{url("/like/{$post->id}")}}'>
                        <button type="button" class="btn">Like({{$likeCtr}})</button>
                      </a>    
                  </li> 
                  <li role="presentation">
                      <a href='{{url("/comment/{$post->id}")}}'>
                        <button type="button" class="btn">Comment</button>
                      </a>    
                  </li>    
              </ul> 
              <br>
              <form method="POST" action='{{ url("/comment/{$post->id}") }}'>
                @csrf
                  <div class="form-group">
                    <textarea name="comment" id="comment" rows="3" class="form-control" required autofocus></textarea>  
                  </div> 
                  <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Comment</button>
                  </div>
              </form> 
              @endif               
              <h4>Comments</h4>  
              @if(count($comments)>0)
                @foreach($comments->all() as $comment)
                  <p>{{$comment->comment}}</p>
                  <p>Posted by:{{$comment->name}}</p>
                  <hr>
                @endforeach
              @else
                <p>No Comments found</p> 
              @endif                                          
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection