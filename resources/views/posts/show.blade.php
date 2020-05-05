@extends('layouts.app')

@section('content')
<br>
<a href="/filo/public/posts/" class= "btn btn-primary">Go Back</a>
<br><br>
<h1>{{$post->title}}</h1>


<div class="row">
    <div class="col-md-4 col-sm-4">
        <img style ="width:100% height:100%" height="300" width="300" src="/filo/public/storage/cover_images/{{$post->cover_image}}">
    </div>
    <div class="col-md-8 col-sm-8">

        <p class="h5">Type</p>
        <p>{{$post->type}}</p>


        <p class="h5">Description</p>
        <p>{{$post->description}}</p>
        
   

        <p class="h5">Colour</p>
        <p>{{$post->colour}}</p>

        <p class="h5">Location</p>
        <p>{{$post->found_location}}</p>
        
    </div>

</div>

<hr>

<small>Posted on {{$post->created_at}}</small>
<hr>

@if(!Auth::guest())

    @if(Auth::user()->id == $post->user_id)

<a href="/filo/public/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>


{!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}

    {{Form::hidden('_method', 'DELETE')}}

    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}

{!!Form::close()!!}

    @endif
@endif
@endsection
