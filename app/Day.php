<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = [
        'name',
        'is_available',
        'lesson_id',
        'description',
        'task',
        'answer'
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }
}
