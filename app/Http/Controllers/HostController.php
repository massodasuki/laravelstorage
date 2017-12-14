<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HostController extends Controller
{
    //
            $albums = Album::with('Photos')->get();
        return view('albums.index')->with('albums', $albums);
    }

    public function create()
    {
    	return view('albums.create');
    }

    public function store(request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image | max:1999'

            ]);




        //Create Album Model
        $album = new Album;
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        //$album->cover_image = $filenameToStore;


        if ($request->hasFile('cover_image')) {


        $fileSize = $request->file('cover_image')->getClientSize();

        //Get filename with extentsion
        $filenameWithWExt = $request->file('cover_image')->getClientOriginalName();

        //Get just a filename
        $filename = pathinfo($filenameWithWExt, PATHINFO_FILENAME);

        //Get extextsion
        $extension =  $request->file('cover_image')->getClientOriginalExtension();

        //Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        //Upload Image
        $path=$request->file('cover_image')->storeAs('public/album_cover', $filenameToStore);

        
        //Create Album Model
        //$album = new Album;
        //$album->name = $request->input('name');
        //$album->description = $request->input('description');
        $album->cover_image = $filenameToStore;


        }
        else
        {
            //Create Album Model
        //$album = new Album;
        //$album->name = $request->input('name');
        //$album->description = $request->input('description');
        $album->cover_image = 'defaultfolder.png';

        }


        
       

        $album->save();

        return redirect('/albums')->with('success', 'Folder Created');
    }


    public function show($id){

        $album = Album::with('Photos')->find($id);
        return view('albums.show')->with('album', $album);

    }

    public function destroy($id){

        $album = Album::find($id);

        
        //delete thumbnail
        $filepath = '/public/album_cover/'.$album->cover_image;
        Storage::delete($filepath);

        //delete directory in photos
        $directory = '/public/photos/'.$id;
        Storage::deleteDirectory($directory);

        //delete database by using model
        $album->delete();

        return redirect('/albums')->with('success', 'Folder Deleted');
        


    }
}
