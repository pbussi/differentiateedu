<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    //

	public function profile($id){

		$u=User::find($id);

		 return view('user/profile',['user'=>$u]);

	}
}
