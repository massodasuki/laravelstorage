<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotoController extends Controller
{
    //
    public function create($album_id){

    	return view('photos.create')->with('album_id', $album_id);

    }

    public function store(request $request)
    {
    	$this->validate($request, [
            'title' => 'required',
            'file' => 'required |file| max:2999' //change this for different type of file


            ]);

        //Get filename with extentsion
        $filenameWithWExt = $request->file('file')->getClientOriginalName();

        //Get just a filename
        $filename = pathinfo($filenameWithWExt, PATHINFO_FILENAME);

        //Get extextsion
        $extension =  $request->file('file')->getClientOriginalExtension();

        //Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        //Upload Image
        $path=$request->file('file')->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);

        
    	//Upload Photo Model
        $photo = new Photo;
        $photo->album_id = $request->input('album_id');
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->size = $request->file('file')->getClientSize();
        $photo->format = $extension;
        $photo->photo = $filenameToStore;
        $photo->save();

        return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo Uploaded');
    }

    public function show($id){

    	$photo = Photo::find($id);
    	return view('photos.show')->with('photo', $photo);

    }

    public function destroy($id){
    	$photo = Photo::find($id);

    	if(Storage::delete('/public/photos/'.$photo->album_id.'/'.$photo->photo)){

    		$photo->delete();

    		return redirect('/')->with('success', 'Photo Deleted');
    	}


    }

}
