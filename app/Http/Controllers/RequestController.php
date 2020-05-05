<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Requests;

class RequestController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'except' => ['index', 'show']
        ]);
    } 

    public function index(){

        $requests = Requests::all();
        return view('requests.index')->with('requests', $requests);
    }

    public function create($id){

        $posts = Post::find($id);
        return view('requests.create')->with('posts', $posts);
    }

    public function store(Request $request){

        $this->validate($request, [
            'reason' => 'required'
        ]);

        $requests = new Requests();
        $requests->reason = $request->input('reason');
        $requests->status = $request->input('status');
        $requests->user = auth()->user()->id;
        $requests->post = $request->input('id');
        $requests->save();

        return redirect('/posts')->with('success', 'A member will be reviewing your request shortly');
    }

    public function show($id){
        $requests = Requests::find($id);
        return view('requests.show')->with('requests', $requests);
    }

    public function destroy($id){
        $requests = Requests::find($id);
        $requests->delete();
        return redirect('/requests');
    }

    public function approveRequest($id){
        $requests = Requests::find($id);
        $requests->status = 'Approved';
        $requests->save();

        return redirect('/requests')->with('success', 'Success! Response sent.');
    }

    public function revokeRequest($id){
        $requests = Requests::find($id);
        $requests->status = 'Revoked';
        $requests->save();

        return redirect('/requests')->with('success', 'Success! Response sent.');
    }
}
