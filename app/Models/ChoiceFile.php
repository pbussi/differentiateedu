<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChoiceFile extends Pivot
{
     protected $fillable = [
     	'file_id',
        'description',
        'choice_id'
      

    ];
}