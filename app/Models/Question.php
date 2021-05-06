<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
    ];
    public function category(){
    	return $this->belongsTo(Category::class);
    }

     public function teacher(){
    	return $this->belongsTo(Teacher::class);
    }

    public function choices(){
		return $this->hasMany(Choice::class);
    }

    public function assignments(){
    	return $this->hasMany(Assignment::class);
    }

}
