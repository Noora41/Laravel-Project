@extends('layouts.app')
<style type="text/css">
	.image{
	        border-radius:100%;
	        max-width:150px;
	    }
	    .header{
	        text-align: center;
	        margin-right:50px; 
	    }
	    .post{
	        margin-bottom:30px;
	    }
</style>@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">

				<div class="card-header">Posts</div>
				<div class="card-body">@if (session('status'))
					<div class="alert alert-success">{{ session('status') }}</div>@endif
					<div class="row">
                        <div class="col-md-4">@if(!empty($profile))
                            
							<img src="{{$profile->profile_pic}}" class="image" alt="">@else
							<img src="{{'upload_media/default-profile-picture.jpg'}}" class="image" alt="">@endif @if(!empty($profile))
							<p class="header">{{$profile->name}}</p>@else
							<p></p>@endif @if(!empty($profile))
							<p class="header">{{$profile->designation}}</p>@else
                            <p></p>@endif</div>
                            
						<div class="col-md-8">@if(count($posts)>0) @foreach($posts as $post)
							<h4 style="color:#000;">{{$post->title}}</h4>
							<img width="70%;" src="/storage/cover_images/{{$post->cover_image}}" alt="">
							<br>
							<br> <small>Written on {{$post->created_at}} by {{$post->user['name']}}</small> 
							<h3 style="color:#000;">Ingredients:</h3> 
							<h4 style="color:#000;">{!!$post->ingredients!!}</h4>
							<br>
							<h3 style="color:#000;">Instructions:</h3>
							<h4 style="color:#000;">{{substr(strip_tags($post->instructions),0,60)}}</h4> 
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
							<hr>@endforeach @else
							<p>No Posts Found</p>@endif {!!$posts->links()!!}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-lg-12 post">
					<div class="card">
						<div class="card-header">Featured Posts</div>
						<div class="card-body">@foreach($featuredpost->all() as $featuredpost)
							<div class="row">
								<div class="col-md-4">
									<img style="width:80%;margin-bottom:10px;" src="/storage/cover_images/{{$featuredpost->cover_image}}" alt="">
								</div>
								<div class="col-md-8"> 
                                    <a style="font-size:16px;" href="/posts/{{$featuredpost->id}}">{{$featuredpost->title}}</a>
									<h6>Written on {{$featuredpost->created_at}} by {{$featuredpost->user['name']}}</h6>
								</div>
							</div>@endforeach</div>
					</div>
				</div>
				<div class="col-lg-12 post">
					<div class="card">
						<div class="card-header">Recent Posts</div>
						<div class="card-body">@foreach($recentposts->all() as $recentpost)
							<div class="row">
								<div class="col-md-4">
									<img style="width:80%;margin-bottom:10px;" src="/storage/cover_images/{{$recentpost->cover_image}}" alt="">
								</div>
								<div class="col-md-8"> <a style="font-size:16px;" href="/posts/{{$recentpost->id}}">{{$recentpost->title}}</a>
									<h6>Written on {{$recentpost->created_at}} by {{$recentpost->user['name']}}</h6> 
								</div>
							</div>@endforeach</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>@endsection