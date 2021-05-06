<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    public function teacher(){
    	return $this-belongsTo(Teacher::class);

    }

      public function question(){
    	return $this-belongsTo(Question::class);

    }

    public function asignmmentsFiles()
    {
        return $this->hasMany(AssignmentsFile::class);
    }

      public function choice(){
    	return $this-belongsTo(Choice::class);

    }

}
