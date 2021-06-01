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
        'description',
        'question_id'

    ];

    public function question(){
    	return $this->belongsTo(Question::class);

    }
    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('description')->withPivot('id');
    }

    public function answers(){
    	return $this->hasMany(Answer::class);
    }

    public function links(){
        return $this->hasMany(Link::class);
    }


}

