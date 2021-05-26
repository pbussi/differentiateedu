<?php

namespace App\Http\Controllers;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
	
	public function deleteLink($id)
	{

		$link=Link::find($id);
		$choice_id=$link->choice_id;

		if ($link){
			$link->delete();
			return redirect()->route('teacherChoice.edit',$choice_id)->with('success','Content deleted!');
		
		}
		else
			return redirect()->route('teacherChoice.edit',$choice_id)->with('error','Cant delete url!');
		 
	}

	
}


