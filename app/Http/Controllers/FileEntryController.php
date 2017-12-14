<?php
//https://www.codetutorial.io/laravel-5-file-upload-storage-download/
namespace App\Http\Controllers;

//use Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Fileentry;
use File;
use Zip;


class FileEntryController extends Controller
{
    //
    public function index()
	{
		$entries = Fileentry::all();
 
		return view('fileentries.index', compact('entries'));
	}
 
	public function add( request $request ) {

		$this->validate($request, [
            'webname' => 'required',
            'filefield' => 'required |file| max: 3145728' //change this for different type of file


            ]);

		
 		$file = $request->file('filefield');
		//$file = Request::file('filefield');
		$extension = $file->getClientOriginalExtension();

		$entry = new Fileentry();
		$entry->mime = $file->getClientMimeType();
		$entry->original_filename = $file->getClientOriginalName();
		$entry->filename = $file->getFilename().'.'.$extension;

		//$getwebname = Request::input('webname');
		$getwebname =$request->input('webname');
		$entry->webname = $getwebname;


		
		//https://github.com/zanysoft/laravel-zip
		

		if ($extension == 'zip')
		{
		$zip = Zip::open($file);
		$zip->extract('C:/Users/Masso/Desktop/uploads');
		} //end zip
		else
		{
		Storage::disk('customs')->put($file->getFilename().'.'.$extension,  File::get($file));
		}


		$entry->save();
 
		return redirect('fileentry');
		
	}

		public function get($filename){


		$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
		$file = Storage::disk('customs')->get($entry->filename);

		

		 return (new Response($file, 200))
            ->header('Content-Type', $entry->mime);

	}
}
