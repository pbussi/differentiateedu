<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'selected_at',
        'completed_at',
        'student_id',
        'question_id',
        'choice_id',
        'notes',
        'review_date',
        'mark',
        'teacher_notes',
    ];
 

      public function question(){
    	return $this-belongsTo(Question::class);

    }

  

      public function choice(){
    	return $this-belongsTo(Choice::class);

    }

      public function files()
    {
         return $this->belongsToMany(File::class)->withPivot('id');
    }

}
