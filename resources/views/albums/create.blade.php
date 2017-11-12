@extends('layouts.app')

@section('content')
<h3>Create Folder</h3>

<hr>

{!!Form::open(['action' => 'AlbumController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
{{Form::text('name','',['placeholder'=>'Folder Name'])}}
{{Form::textarea('description','',['placeholder'=>'Folder Description'])}}
{{Form::file('cover_image')}}
<p>Upload image or let it empty</p>
{{Form::submit('Submit')}}
{!!Form::close()!!}


@endsection