@extends('layouts.app')

@section('content')
<h3>Upload File</h3>

{!!Form::open(['action' => 'PhotoController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
{{Form::text('title','',['placeholder'=>'File Title'])}}
{{Form::textarea('description','',['placeholder'=>'File Description'])}}
{{Form::hidden('album_id', $album_id )}}
{{Form::file('file')}}
{{Form::submit('Submit')}}
{!!Form::close()!!}


@endsection