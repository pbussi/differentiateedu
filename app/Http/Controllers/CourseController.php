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
use App\Models\Question;
use App\Models\Answer;

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
       $course->code=generate_string(6);

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


    public function QRInvitation($code){

      $course=Course::where('code',"=",$code)->get();

      $student=Auth::user()->students[0];
     
      if (count($course)>0){
        $course=$course[0];

        $courseStudent=CourseStudent::where('course_id',"=",$course->id)->where('student_id',"=",$student->id)->get();
        if (count($courseStudent)==0){
          $courseStudent=CourseStudent::create(['student_id'=>$student->id, 
                                'course_id'=>$course->id]);
          $courseStudent->save();
        }
           return redirect()->route('myactivities.questionList',['course_id'=>$course->id])->with('success','Welcome to class');

      }else{
        //invalid QR code
         return redirect()->route('myactivities')->with('error','Invalid QR Code');
      }
    }


     



    public function DeleteStudentFromClass($course_id,$student_id){
        $student=CourseStudent::where('student_id',$student_id)->
                       where('course_id',$course_id)->first();
        if ($student!==null){
          $student->delete();
          return redirect()->route('participants',['course_id'=>$course_id])->with('success','Student has been delete from class');  
        }

    }


    public function delete($id){

        $question=Question::where('course_id',"=",$id)->get();
        if (count($question)>0)
          return redirect()->route('mycourses')->with('error','Class can not be delete');  
        else
          {
            Course::find($id)->delete();
            return redirect()->route('mycourses')->with('success','Class has been deleted ');  

          }
    
    }

public function studentsResults($course_id){

  $course=Course::find($course_id);
  //$courseStudent=CourseStudent::where('course_id',"=",$course->id)->get();

  foreach ($course->students as $student){
    foreach ($course->questions as $question){
        echo "estudiante <B>".$student->user->name."</b><br>";
        echo "Question ".$question->title."<br>"; 
        $answer=Answer::where('question_id',"=",$question->id)->where('student_id',"=",$student->id)->get();
        if (count($answer)>0){
          echo "respuesta Grade: ".$answer[0]->mark."<br>";
           echo "respuesta Teacher Notes: ".$answer[0]->teacher_notes."<br>";
        }else{

          echo "Not presented <br>";
        }
    }
  }

}
 


}

function generate_string($strength = 16) {
  $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}