<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'order',
        'question_id'

    ];

    public function question(){
    	return $this-belongsTo(Question::class);

    }
    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('description');
    }

    public function assignments(){
    	return $this->hasMany(Assignment::class);
    }

}

