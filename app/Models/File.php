<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
      protected $fillable = [
        'type',
        'hash',
        'filename',
        'original_filename',
    ];

    public function choices()
    {
        return $this->belongsToMany(Choice::class)->withPivot('description');
    }
    public function anwers()
    {
        return $this->belongsToMany(Answer::class);
    }
}

