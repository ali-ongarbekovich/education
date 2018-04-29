<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable = [
        'name',
        'is_available'
    ];

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }
}
