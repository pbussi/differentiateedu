<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Choice;
use App\Models\AnswerFile;
use App\Models\File;
use Auth;
use Illuminate\Support\Facades\Storage;

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
     
        return redirect()->route('answerActivities',$choice->id)->with('success','Complete this work until due date!');
      
    }

    public function answerActivities(Request $request, $id){
      //$id es el choice_id elegido en myanwer
        $choice=Choice::find($id);
        $question=Question::find($choice->question_id);
        $answer=Answer::where('question_id',"=",$question->id)->
                       where('student_id',"=",Auth::user()->students[0]->id)->
                       where('choice_id',"=",$id)->get();
        if ($request->isMethod('GET')){
          return view('student/answerActivities',['myanswerChoice'=>$choice,'question'=>$question,'answer'=>$answer[0]]);
        }
        if ($request->isMethod('POST')){
          $answer[0]->notes=$request->notes;
          $answer[0]->completed_at=date('Y-m-d H:i:s');
          $answer[0]->save();
          return redirect()->route('questionShow',$question->id)->with('success','Your work has been successfully sent');
        }

    }

     public function uploadWork(Request $request,$id)
    {
 
    $path=$request->file->store('StudentWork');
    $file=File::create([ 'type' => $request->file->getMimeType(),
                                  'hash'=>uniqid(),                
                                  'filename'=>$path,
                                  'original_filename'=>$request->file->getClientOriginalName()]);
    
    $file->save();
    $lastInsertId=$file->id;

    $answer=Answer::find($id);


    $p=AnswerFile::create(['file_id'=>$lastInsertId,
                            'answer_id'=>$id]);
    $p->save();

       return redirect()->route('answerActivities',$answer->choice_id)->with('success','File uploaded!');

    }

    public function deleteWork($answer_id,$file_id)
    {
           $answer=Answer::where('student_id',"=",Auth::user()->students[0]->id)->
                            where('id',"=",$answer_id)->get();
            
           $answer_file=AnswerFile::where('answer_id',"=",$answer[0]->id)->
                                    where('file_id',"=",$file_id)->get();
          $answer_file[0]->delete();
          $file=File::find($file_id);
          $file_name=$file->filename;

          File::destroy($file->id);
          Storage::delete($file_name);
          return redirect()->route('answerActivities',$answer[0]->choice_id)->with('success','File deleted!');
    }


    public function saveDraft($answer_id){

      $answer=Answer::find($answer_id);
      $question=Question::find($answer->question_id);

      $answer->updated_at=date('Y-m-d H:i:s');
      $answer->save();
     
      return redirect()->route('myactivities.questionList',$question->course_id)->with('success','Draft has been saved.  Remember submit your work when finished it!');
    }


    public function viewMyWork($choice_id){

        //$id es el choice_id elegido en myanwer
        $choice=Choice::find($choice_id);
        $question=Question::find($choice->question_id);
        $answer=Answer::where('question_id',"=",$question->id)->
                       where('student_id',"=",Auth::user()->students[0]->id)->
                       where('choice_id',"=",$choice_id)->get();
        return view('student/viewMyWork',['myanswerChoice'=>$choice,'question'=>$question,'answer'=>$answer[0]]);
        



    }
}

