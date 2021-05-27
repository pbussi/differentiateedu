<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Course;
use App\Models\Student;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use App\Models\CourseStudent;



class CourseController extends Controller
{

public function list()
{
	$courses=Auth::user()->teachers[0]->courses->sortByDesc('updated_at');
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

       		$course->picture_id=2;
       }
       $course->fill($input)->save();
       return redirect()->route('mycourses')->with('success','Class has been created successfully');
    }


    public function edit(Request $request, $id)
    {
    	$course=Course::find($id);
    	if ($request->isMethod('GET'))
      {
        	return view('courses/edit',['course'=>$course]);
      }else
          {
            $input=$request->all();unset($input['_token']);
            if ($request->picture)
            {
              $file_ant=File::find($course->picture_id);
              $path=$request->picture->store('material'); //grabo nuevo pic en disco
              $file=File::create([ 'type' => $request->picture->getMimeType(),
                                    'hash'=>uniqid(),                
                                    'filename'=>$path,
                                    'original_filename'=>$request->picture->getClientOriginalName()]);
              $file->save(); //guarda en base de datos
              $course->picture_id=$file->id;
              $course->save();

              
               $file_ant->delete();  // borro de la bd
               Storage::delete($file_ant->filename); //borro del disco
             

            
            }
            $course->fill($input)->save();
            return redirect()->route('mycourses')->with('success','Class updated!');
        }

    }

    public function participants($id){

      $course=Course::findorFail($id);
      return view('courses/participants',['course'=>$course]);

    }


    public function participantsGetAll(Request $request){
        header("Content-Type: application/json");
        $students=Student::all();
        $resp=array();
        $term=$request->term;
        if ($term=="") die;
        foreach ($students as $student) {
            if(stripos($student->user->name,$term)!==false){
            $resp[]= array('id'=>$student->id,'name'=>$student->user->name,'email'=>$student->user->email,'label'=>$student->user->name."-".$student->user->email);
        }
    }
     echo json_encode($resp);

     die;

    }

    public function AddStudentToClass($course_id,$student_id){
      $mailto=Student::find($student_id);
 
      $student=CourseStudent::where('student_id',$student_id)->
                     where('course_id',$course_id)->get();
      if (count($student)>0){
           return redirect()->route('participants',['course_id'=>$course_id])->with('error','Student is already participating in the class');
      
      }
         $newStudent=CourseStudent::create([ 'course_id' => $course_id,
                                             'student_id'=>$student_id]);
        $newStudent->save();
        mail($mailto->user->email, "You have been added to a class", "vamos a probarlo primero\n puede ser?");
         return redirect()->route('participants',['course_id'=>$course_id])->with('success','Student added. Mail sent to: '.$mailto->user->email);
    }


    public function DeleteStudentFromClass($course_id,$student_id){
        $student=CourseStudent::where('student_id',$student_id)->
                       where('course_id',$course_id)->first();
        if ($student!==null){
          $student->delete();
          return redirect()->route('participants',['course_id'=>$course_id])->with('success','Student has been delete from class');  
        }

    }


}