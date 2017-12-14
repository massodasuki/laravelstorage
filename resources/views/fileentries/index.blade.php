@extends('layouts.app')
@section('content')
 
 <hr>
    <form action="{{route('addentry', [])}}" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    	{{Form::text('webname','',['placeholder'=>'Web Site Name'])}}
        <input type="file" name="filefield">
        <input type="submit">
    </form>
 
 <h2> Website List</h2>
 <div class="row">
        <ul class="thumbnails">
 @foreach($entries as $entry)
            <div class="col-md-2">
                <div class="thumbnail">
                    
                    <div class="caption">
                        <p>{{$entry->webname}}</p>
                        <p>C:/Users/Masso/Desktop/uploads/{{$entry->filename}}'</p>
						<input type="button" class="button success" value="OPEN" onclick="window.open('C:/Users/Masso/Desktop/uploads/{{$entry->filename}}')" />
                    </div>
                </div>
            </div>
 @endforeach
 </ul>
 </div>
 
@endsection
