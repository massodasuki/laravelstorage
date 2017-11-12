@extends('layouts.app')

@section('content')
<h3>Storage</h3>
<hr>


@if (count($albums) > 0)
	<?php

		$colcount = count($albums);
		$i = 1;

	?>

	<div id="albums">
		<div class="row text-center">


		@foreach($albums as $album)

			@if($i == $colcount)
				<div class='medium-4 columns end'>
					<a href="/albums/{{$album->id}}">
					@if($album->cover_image == 'defaultfolder.png')
					<img class="thumbnail" src="storage/default/{{$album->cover_image}}" alt="{{$album->name}}" height="100" width="100">
					@else
					<img class="thumbnail" src="storage/album_cover/{{$album->cover_image}}" alt="{{$album->name}}" height="100" width="100" >
					@endif
					</a>
					<br></br>
					<h4>{{$album->name}}</h4>

			@else
				<div class='medium-4 columns'>
					<a href="/albums/{{$album->id}}">
					@if($album->cover_image == 'defaultfolder.png')
					<img class="thumbnail" src="storage/default/{{$album->cover_image}}" alt="{{$album->name}}" height="100" width="100">
					@else
					<img class="thumbnail" src="storage/album_cover/{{$album->cover_image}}" alt="{{$album->name}}" height="100" width="100">
					@endif
					</a>
					<br>

			<h4>{{ $album->name}}</h4>

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
    <p>No Folder To Displays</p>

@endif


@endsection