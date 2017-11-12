@extends('layouts.app')
<!--id is for album id-->
@section('content')

<h1>{{$album->name}}</h1>
<a class="button secondary" href="/">Go Back</a>
<a class="button" href="/photos/create/{{$album->id}}">Upload File To Folder</a>

{!! Form::open(['action' => ['AlbumController@destroy', $album->id], 'method' => 'POST']) !!}
{{ Form::hidden('_method', 'DELETE')}}
{{Form::submit('Delete This Folder', ['class' => 'button alert'])}}
{!!Form::close()!!}
<hr>



@if (count($album->photos) > 0)
	<?php

		$colcount = count($album->photos);
		$i = 1;

	?>

	<div id="photos">
		<div class="row text-center">


		@foreach($album->photos as $photo)

			@if($i == $colcount)
				<div class='medium-4 columns end'>

				@if ($photo->format == 'pdf' )

				<a href="/photos/{{$photo->id}}">
				<img src="/storage/default/defaultpdf.png" alt="{{$photo->title}}" width="100px" height="100px">
				</a>
					<br><br>
				
				@elseif ($photo->format == 'mp4')

				<a href="/photos/{{$photo->id}}">
				<img src="/storage/default/defaultvideo.png" alt="{{$photo->title}}" width="100px" height="100px">
				</a>
					<br><br>

					@else

					<a href="/photos/{{$photo->id}}">
					<img class="thumbnail" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}" width="100px" height="100px">
					</a>
					<br></br>
				@endif

					<h4>{{$photo->title}}</h4>

			@else

				<div class='medium-4 columns'>

				@if ($photo->format == 'pdf' )

					<a href="/photos/{{$photo->id}}">
					<img src="/storage/default/defaultpdf.png" alt="{{$photo->title}}" width="100px" height="100px">
					</a>
					<br><br>
				
				@elseif ($photo->format == 'mp4')

					<a href="/photos/{{$photo->id}}">
					<img src="/storage/default/defaultvideo.png" alt="{{$photo->title}}" width="100px" height="100px">
					</a>
					<br><br>

				@else

					<a href="/photos/{{$photo->id}}">
					<img class="thumbnail" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}" width="100px" height="100px">
					</a>
					<br></br>

				@endif

					<h4>{{$photo->title}}</h4>

			@endif

		@if($i % 3 == 0)
			</div></div><div class="row text-center">
		@else
			</div>
		@endif

			<?php $i++; ?>

		@endforeach

		</div>
	</div>

@else
    <p>No Files To Displays</p>

@endif



@endsection