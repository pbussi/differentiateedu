<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
use Auth;
class Question extends Model
{
    use HasFactory;


 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'finished_at'
    ];
    public function category(){
    	return $this->belongsTo(Category::class);
    }

     public function course(){
    	return $this->belongsTo(Course::class);
    }

    public function choices(){
		return $this->hasMany(Choice::class);
    }

    public function answers(){
    	return $this->hasMany(Answer::class);
    }

    public function picture(){
        return $this->belongsTo(File::class);
    }

    public function getStudentAnswer(){
         $student_id=Auth::user()->students[0]->id;
         return $this->answers->where('student_id',$student_id)->first();

    }

}
