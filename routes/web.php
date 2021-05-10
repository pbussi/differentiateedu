<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Models\User;
use App\Models\Teacher;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('home');

Route::get('login', 'LoginController@index')->name('login');
Route::get('login/{provider}', 'LoginController@redirectToProvider');
Route::get('{provider}/callback', 'LoginController@handleProviderCallback');
Route::get('/home', function () {




//echo Teacher::find(Auth::id())->user->name;
//print_r(var_dump($user));
    return 'User is logged in';
});

//Route::resource('teacherQuestion', 'TeacherQuestionController');
Route::get('teacherQuestion/list', 'TeacherQuestionController@list')->name('teacherQuestion.list');
Route::post('teacherQuestion/edit/{id}', 'TeacherQuestionController@edit')->name('teacherQuestion.edit');
Route::get('teacherQuestion/show/{id}', 'TeacherQuestionController@show')->name('teacherQuestion.show');
Route::get('teacherChoice/delete/{id}', 'TeacherChoiceController@delete');
Route::post('teacherChoice/add/{id}', 'TeacherChoiceController@add');
Route::post('teacherChoice/addFile/{id}', 'TeacherChoiceController@addFile');
Route::get('teacherChoice/edit/{id}', 'TeacherChoiceController@edit')->name('teacherChoice.edit');
Route::get('file/download/{hash}', 'FileController@download');
Route::get('file/deleteFile/{hash}', 'FileController@deleteFile');
Route::get('userProfile/{id}','UserController@profile');
Route::get('mycourses','CourseController@list')->name('mycourses');
Route::get('mycourses/create','CourseController@create');
Route::post('mycourses/create','CourseController@save');
Route::any('mycourses/edit/{id}','CourseController@edit');
