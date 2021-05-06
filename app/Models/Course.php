<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


      public function students(){
        return $this->hasMany(Student::class);
    }

      public function subjets(){
        return $this->hasMany(Subject::class);
    }

}

