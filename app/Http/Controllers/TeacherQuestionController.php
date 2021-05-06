<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Question;
use App\Models\Choice;
  
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
    public function create()
    {
        //
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
        if($question->teacher_id!=Auth::user()->teachers[0]->id)
            return redirect()->route('teacherQuestion.list')->with('error','Invalid access!');
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
    public function destroy($id)
    {
        //
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $status=$request->input('status');
        if ($status=='' or $status=='all'){
            $questions=Auth::user()->teachers[0]->questions;
            return view('teacherQuestion/list',['questions'=>$questions]);
        }
     
        if ($status=='active'){
            $questions=Auth::user()->teachers[0]->questions->where('finished_at', '>=', date('Y-m-d H:i:s'));

        }else
        {
            $questions=Auth::user()->teachers[0]->questions->where('finished_at', '<', date('Y-m-d H:i:s'));
        }
        return view('teacherQuestion/list',['questions'=>$questions]);
     }   

      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
   

}
