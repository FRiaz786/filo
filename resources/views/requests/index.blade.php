@extends('layouts.app')
@section('content')
<h1>Requests</h1>
<br>
<div class="shadow-lg p-3 mb-4 bg-white rounded">
        <table class="table">
            <br>
            <thead>
                <tr>
                    @if(Auth::user()->role == 1)
                        <th scope="col">Name</th>
                    @endif
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    @if(Auth::user()->role == 1)
                        <th scope="col">Request Decision</th>
                    @endif
                </tr>
            </thead>
            @if(count($requests) > 0)
            <!-- goes through each request displaying it -->
                @foreach($requests as $request)
                    @if(Auth::user()->id == $request->user || Auth::user()->role == 1)
                        <tbody>
                            <tr>
                                @if(Auth::user()->role == 1)
                                <td>
                                    <p>{{$request->users->name}}</p>
                                </td>
                                @endif
                                <td>
                                    <a href="/filo/public/requests/{{$request->id}}">{{$request->posts->title}}</a>
                                </td>

                                <td>{{$request->status}}</td>

                                @if(Auth::user()->role == 1)
                                    @if($request->status == 'Pending')
                                <td> 
                                    <a href="{{action('RequestController@approveRequest', $request->id)}}" class="btn btn-primary">Approve Request</a>
                                    <a href="{{action('RequestController@revokeRequest', $request->id)}}" class="btn btn-danger">Decline</a>
                                </td>
                                    @else
                                    <td>
                                        <p>The request has been dealt with and response has been made.</p>
                                    </td>
                                    @endif
                                @endif
                            </tr>
                        </tbody>
                    @endif
                @endforeach
        </table>
    </div>
    @else
        <p>No Requests to show!</p>
    @endif
@endsection