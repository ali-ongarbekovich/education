<?php

namespace App\Http\Controllers;

use App\Notification;

use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function daily()
    {
        $now = Carbon::now();
        $title = 'Отчет на '.$now;
        $description = 'Ниче не произошло';

        $notification = new Notification;
        $notification->title = $title;
        $notification->description = $description;
        $notification->save();

    }
}
