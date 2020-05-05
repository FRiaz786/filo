@extends('layouts.app')

@section('content')
<h1>{{$requests->posts->title}}</h1>
<hr>
<a href="/filo/public/requests" class="btn btn-secondary">Back</a>
<br><br>
<h4>Requested by {{$requests->users->name}}</h4>
<br>
<div>
    <b>Reason:</b>
        {!!$requests->reason!!}
</div>
<hr>
<small>Request made on: {{$requests->created_at}}</small>
<hr>
@if(Auth::user()->role == 1)
<div>
    <a href="{{action('RequestController@approveRequest', $requests->id)}}" class="btn btn-primary">Accept</a>
    <a href="{{action('RequestController@revokeRequest', $requests->id)}}" class="btn btn-danger">Decline</a>
</div>
@endif
@endsection

