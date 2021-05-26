<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Auth;
use App\Models\Teacher;
use App\Models\File;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    //

	public function profile(Request $request, $id){
        if ($request->isMethod('GET')){
		      $u=User::find($id);
		      return view('user/profile',['user'=>$u]);
        }
        if ($request->isMethod('POST')){
            Auth::user()->name=$request->username;
            Auth::user()->save();
             return view('user/profile',['user'=>Auth::user()]);
        }

	}

	public function inviteStudent(Request $request){
 		if (!(Auth::user()->teacher()))
 			  return redirect()->route('/home')->with('error','Invalid access!');
 		if ($request->isMethod('GET'))
 			return view('user/inviteStudent');
 		else
 		{
 			$email=$request->email;
 			$user = User::where('email', $email)->first();
        	if ($user) {
				return redirect()->route('inviteStudent')->with('error','User already exist!');
        	}
        	 $newUser=User::create([
            'name'     => $email,
            'email'    => $email,
        	 'provider'=>'google',
        	 'provider_id'=>0]);

        	 //creo el new user como estudiante

        	 $student=Student::create([
        	 	'user_id'=>$newUser->id,
                'picture_id'=>7,
        	 ]);

        	 //FALTA ENVIAR EMAIL DE INVITACION
        	 return redirect()->route('inviteStudent')->with('success','Student has been envited!');

 		}
    }

    public function updatePicture(Request $request, $id){

        $user=User::find($id);
        $path=$request->picture->store('users');
        $file=File::create([ 'type' => $request->picture->getMimeType(),
                            'hash'=>uniqid(),                
                            'filename'=>$path,
                            'original_filename'=>$request->picture->getClientOriginalName()]);
    
        $file->save();
         $lastInsertId=$file->id;

        if ($user->teacher){
            //save picture en table teacher
                $teacher=Teacher::find($user->teacher->id);
                $teacher->picture_id=$lastInsertId;
                $teacher->save();
            }
        else{
                $student=Student::find($user->student->id);
                $student->picture_id=$lastInsertId;
                $student->save();
            }

        return redirect()->route('userProfile',$user->id)->with('success','Student has been envited!');

    }
	
}
