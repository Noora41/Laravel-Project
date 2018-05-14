@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Category List</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class='alert alert-success'>
                            {{session('success')}}
                        </div>
                    @endif
                    <a href="{{ url('dashboard/category/add')}}" class="btn btn-primary">Add Category</a>
                    <h3>Your Category List</h3>
                    @if(count($categories)>0)
                    <table class="table table-striped">
                        <tr>
                           <td>Title</td>
                           <td></td>
                           <td></td> 
                        </tr>
                        @foreach($categories as $category)
                         <tr>
                            <td>{{$category->category_name}}</td>
                            <td>
                              <a href="/dashboard/category/edit/{{$category->id}}" class="btn btn-primary">Edit Category</a>
                            </td> 
                            <td>
                              <a href="/dashboard/category/delete/{{$category->id}}" class="btn btn-danger">Delete</a>
                            </td>
                         </tr>
                         @endforeach
                    </table>
                    @else
                     <p>You have no Categories</p>
                    @endif                                        
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection