<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;



      public function course(){
    	return $this->belongsTo(Course::class); 
    }
      public function categories(){
        return $this->hasMany(Category::class);
    }


}
