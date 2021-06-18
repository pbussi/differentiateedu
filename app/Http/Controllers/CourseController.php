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
use App\Models\Choice;
use App\Models\ChoiceFile;
use App\Models\Link;
include('../vendor/shuchkin/simplexlsxgen/src/SimpleXLSXGen.php');
class CourseController extends Controller
{

public function list()
{
	$courses=Auth::user()->teachers[0]->courses->where('archive',0)->sortByDesc('updated_at');
  return view('courses.list',['courses'=>$courses]);
}

public function archivedClasses()
{
  $courses=Auth::user()->teachers[0]->courses->where('archive',1)->sortByDesc('updated_at');
  return view('courses.archivedClasses',['courses'=>$courses]);
}



public function create()
{
    	return view('courses.create_course');
}

    public function save(Request $request)
    {
       $this->validate($request, ['name'=>'required','description_heading'=>'required','description'=>'required','due_date'=>'required']);
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
        $course=Course::find($course_id);
         $newStudent=CourseStudent::create([ 'course_id' => $course_id,
                                             'student_id'=>$student_id]);
        $newStudent->save();
        mail($mailto->user->email, "You have been added to ".$course->title." class", "Check ".env("APP_NAME")." at ".env("APP_URL")." for more details./n");
         return redirect()->route('participants',['course_id'=>$course_id])->with('success','Student added. Mail sent to: '.$mailto->user->email);
    }


    public function QRInvitation($code){

      $course=Course::where('code',"=",$code)->get();

      if (count(Auth::user()->teachers)>0)
        return redirect()->route('mycourses')->with('error','You are a teacher.  Invitation Code is only for students');

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
          return redirect()->route('mycourses')->with('error','Class can not be deleted');  
        else
          {
            $students=CourseStudent::where('course_id',"=",$id)->get();
            foreach ($students as $student){
              $student->delete();
            }

            Course::find($id)->delete();
            return redirect()->route('mycourses')->with('success','Class has been deleted ');  
           }

          }
    
    

public function studentsResults($course_id){
  //header("Content-type: text/csv");
  //header("Content-Disposition: attachment; filename="."results.csv");
  //header("Pragma: no-cache");
  //header("Expires: 0");
echo
  $course=Course::find($course_id);
  $myarray=array('<b>Student Name</b>','<b>Question</b>','<b>Grade</b>','<b>Teacher Notes</b>','<b>Observations</b>');
  //echo arrayToCsv($myarray);
  $matriz=array();
  $matriz[]=$myarray;
  foreach ($course->students as $student){
    foreach ($course->questions as $question){
        $row=array();
        $row['name']=$student->user->name;
         $row['question']=$question->title; 
        $answer=Answer::where('question_id',"=",$question->id)->where('student_id',"=",$student->id)->get();
        if (count($answer)>0){
          $row['grade']=$answer[0]->mark;
          $row['teacherNotes']=$answer[0]->teacher_notes;
          $row['observations']="";
        }else{
          $row['grade']="";
          $row['teacherNotes']="";
          $row['observations']="Not presented";
        }
        $matriz[]=$row;
        //echo arrayToCsv($row);
    }
  }
  SimpleXLSXGen::fromArray( $matriz )
    ->setDefaultFont( 'Courier New' )
    ->setDefaultFontSize( 10 )
    ->downloadAs('studentresults.xlsx');
  die();
}
 

 public function studentsQuestionResults($course_id,$question_id){
  //header("Content-type: text/csv");
  //header("Content-Disposition: attachment; filename="."results.csv");
  //header("Pragma: no-cache");
  //header("Expires: 0");

  $course=Course::find($course_id);
  $question=Question::find($question_id);
  $myarray=array('<b>Student Name</b>','<b>Question</b>','<b>Grade</b>','<b>Teacher Notes</b>','<b>Observations</b>');
  //echo arrayToCsv($myarray);
  $matriz=array();
  $matriz[]=$myarray;
  foreach ($course->students as $student){
  
        $row=array();
        $row['name']=$student->user->name;
        $row['question']=$question->title; 
        $answer=Answer::where('question_id',"=",$question->id)->where('student_id',"=",$student->id)->get();
        if (count($answer)>0){
          $row['grade']=$answer[0]->mark;
          $row['teacherNotes']=$answer[0]->teacher_notes;
          $row['observations']="";
        }else{
          $row['grade']="";
          $row['teacherNotes']="";
          $row['observations']="Not presented";
        }
        $matriz[]=$row;
        //echo arrayToCsv($row);
  }
   SimpleXLSXGen::fromArray( $matriz )
    ->setDefaultFont( 'Courier New' )
    ->setDefaultFontSize( 10 )
    ->downloadAs('studentquestions.xlsx');
  die();

  }


public function clone($course_id){
  $course=Course::find($course_id);
  $newCourse=new Course();
  $newCourse->name="Copy of ".$course->name;
  $newCourse->description_heading=$course->description_heading;
  $newCourse->description=$course->description;
  $newCourse->status=0;
  $newCourse->picture_id=$course->picture_id;
  $newCourse->due_date=date("Y-m-d",strtotime($course->due_date."+ 6 month")); 
  $newCourse->teacher_id=$course->teacher_id;
  $newCourse->save();
  //copy of questions
  $questions=Question::where('course_id',$course_id)->get();
  foreach ($questions as $question){
       $newQ=new Question();
       $newQ->title=$question->title;
       $newQ->description=$question->description;
       $newQ->finished_at=date("Y-m-d",strtotime($question->finished_at."+ 3 month"));
       $newQ->picture_id=$question->picture_id;
       $newQ->course_id=$newCourse->id;
       $newQ->save();
       //copy of question choices
       $choices=Choice::where('question_id',$question->id)->get();
       foreach ($choices as $choice){
          $newChoice=new Choice();
          $newChoice->title=$choice->title;
          $newChoice->order=$choice->order;
          $newChoice->description=$choice->description; 
          $newChoice->question_id=$newQ->id;
          $newChoice->save();
          $choice_files=ChoiceFile::where('choice_id', $choice->id)->get();
          foreach($choice_files as $cfile){
            $newCF=new ChoiceFile();
            $newCF->file_id=$cfile->file_id;
            $newCF->description=$cfile->description;
            $newCF->choice_id=$newChoice->id;
            $newCF->save();
          }
          $links=Link::where('choice_id',$choice->id)->get();
          foreach($links as $link){
            $newLink=new Link();
            $newLink->url=$link->url;
            $newLink->type=$link->type;
            $newLink->choice_id=$newChoice->id;
            $newLink->save();
          }


       }



  }
  return redirect()->route('mycourses')->with('success','Class has been cloned successfully');
}

 
public function archive($course_id){
  $course=Course::findorFail($course_id);
  $course->archive=1;
  $course->save();
  return redirect()->route('mycourses')->with('success','Class has been archived successfully');
}

public function active($course_id){
  $course=Course::findorFail($course_id);
  $course->archive=0;

  $course->save();
  return redirect()->route('mycourses')->with('success','Class is restored now');
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

function arrayToCsv( array &$fields, $delimiter = ';', $enclosure = '"', $encloseAll = false, $nullToMysqlNull = false ) {
    $delimiter_esc = preg_quote($delimiter, '/');
    $enclosure_esc = preg_quote($enclosure, '/');

    $output = '';
    foreach ( $fields as $key => $field ) {
        if ($field === null && $nullToMysqlNull) {
            $output = '';
            continue;
        }

        // Enclose fields containing $delimiter, $enclosure or whitespace
        if ( $encloseAll || preg_match( "/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field ) ) {
            //$output .= $key;
            //$output .= $delimiter;
            $output .= $enclosure . str_replace($enclosure, $enclosure . $enclosure,     $field) . $enclosure;
            $output .= $delimiter;
        }
        else {
            //$output .= $key;
            //$output .= $delimiter;
            $output .= $field;
            $output .= $delimiter;
        }
    }
  $output .= PHP_EOL;
    return  $output ;
}
