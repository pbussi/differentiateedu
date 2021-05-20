<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Choice;
use App\Models\AnswerFile;
use Auth;

class StudentController extends Controller
{
  	public function list()
	{
  		$courses=Auth::user()->students[0]->courses->sortBy('created_at');
  		return view('student.dashboard',['courses'=>$courses]);
	}

	public function questionList(request $request,$id){
      
	 $student_id=Auth::user()->students[0]->id;
	 $student=CourseStudent::where('student_id',$student_id)->
                     		  where('course_id',$id)->get();
      if (count($student)==0){
           return redirect()->route('myactivities')->with('error','You have no access to selected class');
      
      }

      $course=Course::find($id);
       
        $status=$request->input('status');
        if ($status=='' or $status=='all'){
            $questions=$course->questions;
            return view('student/questionList',['questions'=>$questions,'course'=>$course]);
        }
     
        if ($status=='active'){
            $questions=$course->questions->where('finished_at', '>=', date('Y-m-d H:i:s'));

        }else
        {
            $questions=$course->questions->where('finished_at', '<', date('Y-m-d H:i:s'));
        }
        return view('student/questionList',['questions'=>$questions,'course'=>$course]);
    }  

    public function questionShow(Request $request,$id){

    	if ($request->isMethod('GET')){
    		  $question=Question::find($id);
          $answer=Answer::where('question_id','=',$question->id)->
                       where('student_id','=',Auth::user()->students[0]->id)->get();
       
          
        if (count($answer)>0){
          $selectedChoice=Choice::find($answer[0]->choice_id);
          return view('student/questionShow',['question'=>$question,'selectedChoice'=>$selectedChoice,'answer'=>$answer[0]]);
        }else
        {
    		  $choices=$question->choices;
          $selectedChoice=NULL;
          $answer=NULL;
    		  return view('student/questionShow',['question'=>$question,'choices'=>$choices,'selectedChoice'=>$selectedChoice,'answer'=>$answer]);
    	  }
      }
    }

    public function saveMyChoice(Request $request){
       $question=Question::find($request->question_id);
       $answer=Answer::where('question_id',"=",$request->question_id)->
                       where('student_id',"=",Auth::user()->students[0]->id)->get();
     
       if (count($answer)>0){
           $selectedChoice=Choice::find($answer[0]->choice_id);
           return redirect()->route('questionShow',$question->id)->with('error','You have already selected a choice');
         
        }
        $choice=Choice::find($request->choice_id);
      
        $myanswer=Answer::create([ 'selected_at' => date('Y-m-d H:i:s' ),
                                  'student_id'=>Auth::user()->students[0]->id,
                                  'question_id'=>$request->question_id,
                                  'choice_id'=>$request->choice_id]);
        $myanswer->save();
     
        return redirect()->route('answerActivities',['choice_id'=>$choice->id])->with('success','Complete this work until due date!');
      
    }

    public function answerActivities(Request $request, $id){
        if ($request->isMethod('GET')){
          $choice=Choice::find($id);
          $question=Question::find($choice->question_id);
          return view('student/answerActivities',['choice'=>$choice,'question'=>$question]);

        }

    }

     public function uploadWork(Request $request,$id)
    {
 
    $path=$request->file->store('stdWorks');
    $file=File::create([ 'type' => $request->file->getMimeType(),
                                  'hash'=>uniqid(),                
                                  'filename'=>$path,
                                  'original_filename'=>$request->file->getClientOriginalName()]);
    
    $file->save();
    $lastInsertId=$file->id;

    $answer=Answer::find($id);

    $p=AnswerFile::create(['file_id'=>$lastInsertId,
                            'answer_id'=>$answer->id]);
    $p->save();

       return redirect()->route('answerActivities',$id)->with('success','File uploaded!');
   

    }

}
