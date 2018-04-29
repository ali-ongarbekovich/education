<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name',
        'is_available',
        'level_id'
    ];

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function days()
    {
        return $this->hasMany('App\Day');
    }
}
