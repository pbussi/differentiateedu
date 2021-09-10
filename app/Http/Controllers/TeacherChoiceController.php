<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\File;
use App\Models\ChoiceFile;
use App\Models\Link;

class TeacherChoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function delete($id)
    {
        $choice=Choice::find($id);
        $question_id=$choice->question_id;
        //si tiene respuestas no se puede borrar
         if($choice->answers->count()>0)
                return redirect()->route('teacherQuestion.show',$question_id)->with('error','Choice has been selected by a student. Cannot be deleted!');
        
        //borro solo del pivot, no borro el file ya que puede ser usado al clonar una clase.
        $cfiles=ChoiceFile::where('choice_id',$choice->id)->get();
        foreach($cfiles as $cfile){
            $cfile->delete();
        }
        $links=Link::where('choice_id',$choice->id)->get();
        foreach ($links as $link){
            $link->delete();
        }
        $choice->delete();
        return redirect()->route('teacherQuestion.show',$question_id)->with('success','Choice has been deleted!');
    }
    

    public function add(Request $request, $id)
    {
       

        $choice=Choice::create([ 'title' => $request->title,
                                  'order'=>strtoupper($request->order),
                                  'description'=>$request->description,
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
             return redirect()->route('teacherChoice.edit',$choice->id)->with('success','Choice has been updated!');

            }
    }

      public function editContent(Request $request, $id){
         $choice=Choice::findorFail($id);
        if ($request->isMethod('GET')){
            return view('teacherChoice/editContent',['choice'=>$choice]);
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

       return redirect()->route('teacherChoice.editContent',$id)->with('success','File uploaded!');
   

    }


    public function addLink(Request $request,$id)
    {
      https://www.youtube.com/watch?v=YMgf9Dg3QRo
        if ($request->type=='youtube'){
            $pos = strpos($request->url,'youtube.com/watch?v=');
            $pos1 = strpos($request->url,'https://youtu.be/');

            if ($pos===false and $pos1===false)
                 return redirect()->route('teacherChoice.editContent',$id)->with('error','Not a valid Youtube url');
             if ($pos)
                 $code=substr($request->url, $pos+20);
             else
                 $code=substr($request->url, $pos+17);  
             $link=$code;
        }else{

             if ($request->type=='link'){
                $link=$request->url;
                if (substr($link,0,4)!='http')
                    $link='http://'.$link;
                
             }else{
                return redirect()->route('teacherChoice.editContent',$id)->with('error','Invalid entry!');
                }
        }

   
         $link=Link::create(['url'=>$link,
                            'type'=>$request->type,
                            'choice_id'=>$id]);
         $link->save;
   
       return redirect()->route('teacherChoice.editContent',$id)->with('success','Link added!');
   

    }


     public function recordAudio(Request $request,$id){
        $choice=Choice::findorFail($id);
        if ($request->audio){
         $path=$request->audio->store('material');
         $file=File::create([ 'type' => $request->audio->getMimeType(),
                              'hash'=>uniqid(),                
                              'filename'=>$path,
                              'original_filename'=>$request->audio->getClientOriginalName()]);
    
         $file->save();
         $choice->audio_id=$file->id;
        }
       $choice->save();

     }


}
