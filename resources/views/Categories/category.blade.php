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
            <div class="col-md-4">
                <ul class="list-group">
                @if(count($categories)>0)
                    @foreach($categories->all() as $cat)
                        <li class="list-group-item">
                            <a href='{{ url("/category/{$cat->id}") }}'>{{$cat->category_name}}</a>
                        </li>
                    @endforeach
                @else
                    <p>No Category Found!</p> 
                @endif
                </ul>                   
            </div>
            <div class="col-md-8">
              @if(count($posts)>0)
                @foreach($posts->all() as $post)
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
                    <hr><br>
                  @elseif($post->type==1)
                    <h3 style="color:#000;">{{$post->title}}</h3>
                    <br>
                    <img width="70%;"src="/storage/cover_images/{{$post->cover_image}}" alt="">
                    <br><br>
                    <h4 style="color:#000;">{!!$post->instructions!!}</h4> 
                    <hr><br>
                  @endif  
                @endforeach
                @else
                  <p>No Posts Found!</p>
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection