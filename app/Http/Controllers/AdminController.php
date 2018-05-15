<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use App\Level;
use App\Day;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public static function adminThings()
    {
        $response = [];
        $response['lessons'] = Lesson::count();
        $response['new_users'] = User::where('new', 1)->count();
        $response['all_users'] = User::count();
        $response['levels'] = Level::count();
        $response['HW'] = Day::count();
        return $response;
    }
}
