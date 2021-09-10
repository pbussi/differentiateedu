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
     if (count(Auth::user()->teachers)>0)
            return redirect("/mycourses");
        else
            if (count(Auth::user()->students)>0)

                return redirect("/myactivities");
            else 
                return redirect('/login');
})->middleware('auth')->name('home');

Route::any('login', 'Auth\LoginController@index')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/home', function () {


    return 'User is logged in';
});
Route::get('/forgot-password', function () {
    return view('auth.passwords.forgot-password');
})->middleware('guest')->name('password.request');

//Route::resource('teacherQuestion', 'TeacherQuestionController');
Route::get('teacherQuestion/list/{course_id}', 'TeacherQuestionController@list')->name('teacherQuestion.list')->middleware("auth");
Route::post('teacherQuestion/edit/{id}', 'TeacherQuestionController@edit')->name('teacherQuestion.edit')->middleware("auth");
Route::get('teacherQuestion/show/{question_id}', 'TeacherQuestionController@show')->name('teacherQuestion.show')->middleware("auth");
Route::any('teacherQuestion/create/{course_id}','TeacherQuestionController@create')->middleware("auth");
Route::get('teacherQuestion/delete/{question_id}', 'TeacherQuestionController@delete')->middleware("auth");
Route::post('teacherQuestion/recordAudio/{id}', 'TeacherQuestionController@recordAudio')->name('teacherQuestion.recordAudio')->middleware("auth");

Route::get('teacherQuestion/studentsResults/{question_id}', 'TeacherQuestionController@studentsResults')->middleware("auth")->name('studentsResults');

Route::get('mycourses/studentsQuestionResults/{courseid}/{questionid}','CourseController@studentsQuestionResults')->middleware("auth")->name('studentsQuestionResults');

Route::any('teacherQuestion/correct/{answer_id}', 'TeacherQuestionController@correct')->middleware("auth")->name('teacherQuestion.correct');
Route::any('mycourses/globalCorrection/{question_id}', 'TeacherQuestionController@globalCorrection')->middleware("auth")->name('teacherQuestion.globalCorrection');



Route::get('teacherChoice/delete/{id}', 'TeacherChoiceController@delete')->middleware("auth");
Route::post('teacherChoice/add/{id}', 'TeacherChoiceController@add')->middleware("auth");
Route::post('teacherChoice/addFile/{id}', 'TeacherChoiceController@addFile')->middleware("auth");
Route::post('teacherChoice/addLink/{id}', 'TeacherChoiceController@addLink')->middleware("auth");
Route::any('teacherChoice/edit/{id}', 'TeacherChoiceController@edit')->name('teacherChoice.edit')->middleware("auth");
Route::any('teacherChoice/editContent/{id}', 'TeacherChoiceController@editContent')->name('teacherChoice.editContent')->middleware("auth");
Route::post('teacherChoice/recordAudio/{id}', 'TeacherChoiceController@recordAudio')->name('teacherChoice.recordAudio')->middleware("auth");
Route::get('file/download/{hash}', 'FileController@download')->middleware("auth");
Route::get('file/deleteFile/{hash}', 'FileController@deleteFile')->middleware("auth");
Route::any('userProfile/{id}','UserController@profile')->middleware("auth")->name('userProfile');
Route::post('user/updatePicture/{userid}','UserController@updatePicture')->middleware("auth");

Route::get('mycourses','CourseController@list')->name('mycourses')->middleware("auth");
Route::get('mycourses/create','CourseController@create')->middleware("auth");
Route::post('mycourses/create','CourseController@save')->middleware("auth");

Route::get('mycourses/delete/{id}','CourseController@delete')->middleware("auth");
Route::get('mycourses/participants/{course_id}','CourseController@participants')->name('participants')->middleware("auth");
Route::any('mycourses/edit/{id}','CourseController@edit')->middleware("auth");
Route::get('mycourses/studentResults/{course_id}','CourseController@studentsResults')->middleware("auth");
Route::get('mycourses/getallparticipants','CourseController@participantsGetAll')->middleware("auth");
Route::get('mycourses/addStudentToClass/{course_id}/{student_id}','CourseController@addStudentToClass')->middleware("auth");
Route::get('mycourses/clone/{course_id}','CourseController@clone')->middleware("auth");
Route::get('mycourses/DeleteStudentFromClass/{course_id}/{student_id}','CourseController@DeleteStudentFromClass')->middleware("auth");
Route::get('QRInvitation/{code}','CourseController@QRInvitation')->middleware("auth");

Route::any('inviteTeacher','UserController@inviteTeacher')->name('inviteTeacher')->middleware("auth");

Route::any('inviteStudent','UserController@inviteStudent')->name('inviteStudent')->middleware("auth");

Route::get('myactivities','StudentController@list')->name('myactivities')->middleware("auth");
Route::get('myactivities/pendingQuestions','StudentController@pendingWork')->name('pendingQuestions')->middleware("auth");
Route::get('myactivities/questionList/{course_id}','StudentController@questionList')->middleware("auth")->name("myactivities.questionList");
Route::get('myactivities/questionShow/{question_id}','StudentController@questionShow')->name('questionShow')->middleware("auth");
Route::post('myactivities/saveMyChoice/','StudentController@saveMyChoice')->middleware("auth");
Route::any('answerActivities/{choice_id}','StudentController@answerActivities')->name('answerActivities')->middleware("auth");

Route::post('answerActivities/uploadWork/{id}','StudentController@uploadWork')->middleware("auth");
Route::get('answerActivities/deleteWork/{answer_id}/{file_id}','StudentController@deleteWork')->middleware("auth");
Route::get('myactivities/saveDraft/{answer_id}','StudentController@saveDraft')->middleware("auth");
Route::get('myactivities/viewMyWork/{answer_id}','StudentController@viewMyWork')->middleware("auth");

Route::get('link/deleteLink/{id}', 'LinkController@deleteLink')->middleware("auth");
Route::get('mycourses/archive/{course_id}', 'CourseController@archive')->middleware("auth");
Route::get('mycourses/archivedClasses', 'CourseController@archivedClasses')->middleware("auth");
Route::get('mycourses/active/{courseid}', 'CourseController@active')->middleware("auth");




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

