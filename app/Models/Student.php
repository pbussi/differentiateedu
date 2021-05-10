<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    public function user(){
    	return $this->belongsTo(User::class); 
    }


    public function assignments(){
    	return $this->hasMany(Assignment::class);
    }

    public function picture(){
    	return $this->belongsTo(File::class);
    }
}
