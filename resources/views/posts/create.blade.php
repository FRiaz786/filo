@extends('layouts.app')

@section('content')


<br>
<h1>Add Lost Item</h1>

{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}


<div class = "form-group">
    {{Form::label('title' , 'Item')}}
    {{Form::text('title' , '', ['class' => 'form-control' , 'placeholder' => 'Item Name'])}}
</div>

<div class = "form-group">
    {{Form::label('type' , 'Type of Item')}}

  <br>

    {{Form::select('type', ['pet' => 'Pet', 'phone' => 'Phone','jewellery' => 'Jewellery'])}}


</div>


<div class = "form-group">
    
    {{Form::file('cover_image')}}
    
</div>

<div class = "form-group">
    {{Form::label('description' , 'Description')}}
    {{Form::textarea('description' , '', ['class' => 'form-control' , 'placeholder' => 'Item Description'])}}
</div>

<div class = "form-group">
    {{Form::label('colour' , 'Colour')}}
    {{Form::text('colour' , '', ['class' => 'form-control' , 'placeholder' => 'Colour'])}}
</div>

<div class = "form-group">
    {{Form::label('found_location' , 'Found Location')}}
    {{Form::text('found_location' , '', ['class' => 'form-control' , 'placeholder' => 'Found Location' ])}}
</div>




{{Form::submit ('Submit' , ['class' => 'btn btn-primary '])}}

{!! Form::close() !!}
 
@endsection 