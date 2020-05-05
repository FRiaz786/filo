<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{


   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('title', 'desc')->paginate(5);
     

//6

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
           'title' => 'required', 
           'description' => 'required',
           'colour' => 'required',
           'found_location' => 'required',
           'cover_image' => 'image|nullable|max:1999'
          ] );


//handling the file upload
if($request->hasFile('cover_image')){

    //get filename and extension
    $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

    // getting the file name only
    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

    //just ext
    $extension = $request->file('cover_image')->getClientOriginalExtension();

    //filename to store
    $fileNameToStore =$filename.'_'.time().'.'.$extension;

    //uploading the image
    $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

}else{

    $filenameToStore = 'noimage.jpg';
}



       //create post
       $post = new Post;
       $post->title = $request->input('title');
       $post->type = $request->input('type');
       $post->cover_image = $fileNameToStore;
       //$post->image = $request->input('image');
       $post->description = $request->input('description');
       $post->colour = $request->input('colour');
       $post->found_location = $request->input('found_location');
       $post->user_id =auth()->user()->id;
       $post->save();

       return redirect('/posts')->with('success', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post = Post::find($id);
       return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post = Post::find($id);

        //checking for correct user
        if(auth()->user()->id !==$post->user_id){

            return redirect('/posts')->with('error', 'unauthorised page');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        {
            $this->validate($request, [
                'title' => 'required', 
                'description' => 'required',
                'colour' => 'required',
                'found_location' => 'required'
               ] );
     
            //create post
            $post =  Post::find($id);
            $post->title = $request->input('title');
            $post->type = $request->input('type');
            //$post->image = $request->input('image');
            $post->description = $request->input('description');
            $post->colour = $request->input('colour');
            $post->found_location = $request->input('found_location');
            $post->save();
     
            return redirect('/posts')->with('success', 'Post Updated');
     
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !==$post->user_id){

            return redirect('/posts')->with('error', 'unauthorised page');
        }


        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
