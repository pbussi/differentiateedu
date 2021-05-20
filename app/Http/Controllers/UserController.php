<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Auth;


class UserController extends Controller
{
    //

	public function profile($id){

		$u=User::find($id);

		 return view('user/profile',['user'=>$u]);

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
}
