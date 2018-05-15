<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestInfo extends Model
{
    protected $fillable = [
        'user_id',
        'device',
        'platform',
        'browser'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
