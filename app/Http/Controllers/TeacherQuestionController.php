<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\ChoiceFile;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Answer;

use App\Models\Student;

  
class TeacherQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
       $course=Course::findorFail($id);
      

       if ($request->isMethod('GET')){
            return view('teacherQuestion/create',['course'=>$course]);
       }
       if ($request->isMethod('POST')){
             $question=new Question;
             $input=$request->all();unset($input['_token']);
             $question->course_id=$course->id;
             if ($request->picture){
                 $path=$request->picture->store('material');
                 $file=File::create([ 'type' => $request->picture->getMimeType(),
                              'hash'=>uniqid(),                
                              'filename'=>$path,
                              'original_filename'=>$request->picture->getClientOriginalName()]);
    
                $file->save();
                $question->picture_id=$file->id;
             }
           
             $question->fill($input)->save();
             return redirect()->route('teacherQuestion.list',$course->id)->with('success','Question has been created!');
       }

     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $question=Question::find($id);
        if($question->course->teacher_id!=Auth::user()->teachers[0]->id)
            return redirect()->route('mycourses')->with('error','Invalid access!');
        return view('teacherQuestion/show',['question'=>$question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

       $question=Question::findorFail($id);
       $input=$request->all();unset($input['_token']);
        if ($request->picture){
         $path=$request->picture->store('material');
         $file=File::create([ 'type' => $request->picture->getMimeType(),
                              'hash'=>uniqid(),                
                              'filename'=>$path,
                              'original_filename'=>$request->picture->getClientOriginalName()]);
    
         $file->save();
         $question->picture_id=$file->id;
        }
            

       $question->fill($input)->save();
        return redirect()->route('teacherQuestion.show',$question->id)->with('success','Question updated!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $question=Question::findorFail($id);
        $course_id=$question->course_id;

        $choices = Choice::where('question_id', $question->id)->get();
        foreach ($choices as $choice) {  
          if($choice->answers->count()>0)
                return redirect()->route('teacherQuestion.list',$course_id)->with('error','Cannot be deleted!'); 
        }
        foreach ($choices as $choice) {        
            foreach($choice->files as $file){   
                ChoiceFile::destroy($file->pivot->id);
                File::destroy($file->pivot->file_id);
                Storage::delete($file->filename);
            }
            Choice::destroy($choice->id);
        }
       
        Question::destroy($question->id);
        return redirect()->route('teacherQuestion.list',$course_id)->with('success','Question has been deleted!');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function list(Request $request, $id)
    {
        $course=Course::findorFail($id);
        if ($course->teacher_id!=Auth::user()->teachers[0]->id) 
            return redirect()->route('mycourses')->with('error','Invalid Access');
        
        $status=$request->input('status');
        if ($status=='' or $status=='all'){
            $questions=$course->questions;
            return view('teacherQuestion/list',['questions'=>$questions,'course'=>$course]);
        }
     
        if ($status=='active'){
            $questions=$course->questions->where('finished_at', '>=', date('Y-m-d H:i:s'));

        }else
        {
            $questions=$course->questions->where('finished_at', '<', date('Y-m-d H:i:s'));
        }
        return view('teacherQuestion/list',['questions'=>$questions,'course'=>$course]);
     }   


     public function studentsResults($id){

        $question=Question::find($id);
        $course=Course::find($question->course_id);
        $studentsresponse=array();
         foreach (Answer::where('question_id',"=",$id)->get() as $item) {
            $studentsresponse[$item->student_id]=$item->student_id;
        } 
        $students_no_answer=array();
        foreach (CourseStudent::where('course_id',"=",$course->id)->get() as $coursestudent) {
            if (!isset($studentsresponse[$coursestudent->student_id]))
                $students_no_answer[]=Student::find($coursestudent->student_id);
        }
        return view('teacherQuestion/studentsResults',['question'=>$question,'course'=>$course,'students_no_answer'=>$students_no_answer]);
     }


     public function correct(Request $request, $answer_id){

        $answer=Answer::find($answer_id);
         if ($request->isMethod('GET')){
            $answer=Answer::find($answer_id);
            return view('teacherQuestion/correct',['answer'=>$answer]);
         }
         
         if ($request->isMethod('POST')){
            $answer->review_date=date('Y-m-d H:i:s');
            $answer->mark=$request->mark;
            $answer->teacher_notes=$request->teacher_notes;
            $answer->save();
            return redirect()->route('studentsResults',$answer->question_id)->with('success','Correction done!');
         }

     }

     public function recordAudio(Request $request,$id){
        $question=Question::findorFail($id);
        if ($request->audio){
         $path=$request->audio->store('material');
         $file=File::create([ 'type' => $request->audio->getMimeType(),
                              'hash'=>uniqid(),                
                              'filename'=>$path,
                              'original_filename'=>$request->audio->getClientOriginalName()]);
    
         $file->save();
         $question->audio_id=$file->id;
        }
       $question->save();

     }

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
   

}
