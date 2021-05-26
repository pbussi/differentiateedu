<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
 protected $fillable = [
        'user_id',
        'picture_id',
        ];

    public function user(){
    	return $this->belongsTo(User::class); 
    }


   
        public function picture()
    {
        return $this->belongsTo(File::class);
    }

      public function courses(){
        return $this->belongsToMany(Course::class);
    }

     public function answers(){
        return $this->hasMany(Answer::class);
    }

}

