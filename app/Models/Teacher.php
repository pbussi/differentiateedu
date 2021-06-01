<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
class Teacher extends Model
{
    use HasFactory;
protected $fillable = [
        'user_id',
        'picture_id',
        'school_id',
        ];

    public function user(){
    	return $this->belongsTo(User::class); 
    }

        public function picture()
    {
        return $this->belongsTo(File::class);
    }

     public function courses(){
        return $this->hasMany(Course::class); 
    }

     public function school(){
        return $this->belongsTo(School::class); 
    }

}
