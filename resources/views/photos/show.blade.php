@extends('layouts.app')

@section('content')

<h3>{{$photo->title}}</h3>
<p>{{$photo->description}}</p>
<a href="/albums/{{$photo->album_id}}">Back To Gallery</a>
<hr>
@if ($photo->format == 'pdf' )
<img src="/storage/default/defaultpdf.png" alt="{{$photo->title}}">
<br><br>
@elseif($photo->format == 'mp4' || $photo->format == 'avi' || $photo->format == '3gp' || $photo->format == 'mp3' )
<video width="320" height="240" controls>  
<source src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}" type="video/mp4">  
<source src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}" type="video/ogg">  
Your browser does not support the video tag.
</video>
@else
<img src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}">
<br><br>
@endif
<hr>
<a href="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" download="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}">
<button type="button" class="button success">DOWNLOAD</button>
</a>


{!! Form::open(['action' => ['PhotoController@destroy', $photo->id], 'method' => 'POST']) !!}
{{ Form::hidden('_method', 'DELETE')}}
{{Form::submit('DELETE FILE', ['class' => 'button alert'])}}
{!!Form::close()!!}
<hr>
<small>Size: {{$photo->size}}</small>

@endsection