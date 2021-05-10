<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'description_heading',
        'status',
        'picture_id',
        'due_date',
        'teacher_id',

    ];

     public function picture(){
    	return $this->belongsTo(File::class);
    }
       public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }


}
