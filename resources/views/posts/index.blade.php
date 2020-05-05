@extends('layouts.app')

@section('content')
<h1>Lost Items</h1>
    @if(count($posts) > 0)
        @foreach ($posts as $post)
        <div class=" jumbotron well">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <img style ="width:100% height:100%" height="200" width="200" src="/filo/public/storage/cover_images/{{$post->cover_image}}">
                </div>
                <div class="col-md-8 col-sm-8">
                    <h3><a href="/filo/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Posted on {{$post->created_at}}</small>
                    <br>
                    @if(!Auth::guest())
                        <a href="{{action('RequestController@create', $post->id)}}" class="btn btn-primary">Request</a>
                    @endif
                </div>

            </div>
        </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No Items have been Posted</p>
    @endif
@endsection 