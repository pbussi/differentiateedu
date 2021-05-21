<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AnswerFile extends Pivot
{
    protected $fillable = [
      
        'answer_id',
        'file_id',
       
    ];
 
}