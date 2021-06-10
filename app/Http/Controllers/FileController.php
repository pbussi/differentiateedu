<?php

namespace App\Http\Controllers;
use App\Models\File;
use App\Models\ChoiceFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FileController extends Controller
{
	public function download($hash)
	{
		$file=File::where('hash',$hash)->first();

		return Storage::download($file->filename,$file->original_filename);
	}

	public function deleteFile($hash)
	{

		$file = File::where('hash', $hash)->first();
		Storage::delete($file->filename);
		$pivot_file = ChoiceFile::where('file_id',$file->id)->first();
		$choice_id=$pivot_file->choice_id;
		$pivot_file->delete();
		$file->delete();

		 return redirect()->route('teacherChoice.editContent',$choice_id)->with('success','File has been deleted!');

	}

	
}


