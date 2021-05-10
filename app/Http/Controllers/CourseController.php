<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Course;
use App\Models\File;



class CourseController extends Controller
{

public function list()
{
	$courses=Auth::user()->teachers[0]->courses;
	return view('courses.list',['courses'=>$courses]);
}

   public function create()
    {
    	return view('courses.create_course');
    }

    public function save(Request $request)
    {
       $course=new Course();
       $input=$request->all();unset($input['_token']);
       $course->status="0"; //open Class
       $course->teacher_id=Auth::user()->teachers[0]->id;
       if ($request->picture){
       	 $path=$request->picture->store('material');
       	 $file=File::create([ 'type' => $request->picture->getMimeType(),
                              'hash'=>uniqid(),                
                              'filename'=>$path,
                              'original_filename'=>$request->picture->getClientOriginalName()]);
    
    	 $file->save();
    	 $course->picture_id=$file->id;
    	    
       }else{

       		$course->picture_id=1;
       }
       $course->fill($input)->save();
      //  return redirect()->route('teacherQuestion.show',$question->id)->with('success','Question updated!');
       return view('courses.create_course');
    }

    public function edit(Request $request, $id){
    	$course=Course::find($id);
    	if ($request->isMethod('GET')){
        	return view('courses/edit',['course'=>$course]);
        }else{

        	$input=$request->all();unset($input['_token']);
        	$course->fill($input)->save();
        	return redirect()->route('mycourses')->with('success','Class updated!');


        }

    }


}