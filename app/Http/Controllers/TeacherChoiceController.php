<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\File;
use App\Models\ChoiceFile;

class TeacherChoiceController extends Controller
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
    public function show($id)
    {
        //
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


    public function delete($id)
    {
        $choice=Choice::find($id);
        $question_id=$choice->question_id;
        //si tiene respuestas no se puede borrar
         if($choice->answers->count()>0)
                return redirect()->route('teacherQuestion.show',$question_id)->with('error','Choice has been selected by a student. Cannot be deleted!');
        foreach($choice->files as $file){
            $file->pivot->delete();
        }
        $choice->delete();
        return redirect()->route('teacherQuestion.show',$question_id)->with('success','Choice has been deleted!');
    }

    public function add(Request $request, $id)
    {
       

        $choice=Choice::create([ 'title' => $request->title,
                                  'order'=>strtoupper($request->order),
                                  'question_id'=>$id]);
        $choice->save();
        return redirect()->route('teacherQuestion.show',$id)->with('success','Choice has been created!');


    }

    public function edit(Request $request, $id){
         $choice=Choice::findorFail($id);
        if ($request->isMethod('GET')){
            return view('teacherChoice/edit',['choice'=>$choice]);
            }
        else {
            $choice->title=$request->title;
            $choice->order=$request->order;
            $choice->description=$request->description;
            $choice->save();
             return redirect()->route('teacherQuestion.show',$choice->question_id)->with('success','Choice has been updated!');

        }

    }

    public function addFile(Request $request,$id)
    {
 
    $path=$request->file->store('material');
    $file=File::create([ 'type' => $request->file->getMimeType(),
                                  'hash'=>uniqid(),                
                                  'filename'=>$path,
                                  'original_filename'=>$request->file->getClientOriginalName()]);
    
    $file->save();
    $lastInsertId=$file->id;
 

    $p=ChoiceFile::create(['file_id'=>$lastInsertId,
                            'choice_id'=>$id,
                            'description'=>$request->title]);
    $p->save();

       return redirect()->route('teacherChoice.edit',$id)->with('success','File uploaded!');
   

    }

}
