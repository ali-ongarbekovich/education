<?php

namespace App\Http\Controllers;

use App\User;
use App\Notification;

use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public static function daily()
    {
        $now = Carbon::now();
        $title = 'Отчет на '.$now;
        $newUsers = User::where('new', 1)->get();
        $description = 'Новые пользователи:<br>';
        foreach ($newUsers as $user) {
            $description .= $user->name.'<br>';
        }
        User::where('new', 1)->update(['new' => 0]);

        $notification = new Notification;
        $notification->title = $title;
        $notification->description = $description;
        $notification->save();

    }

    public static function newUser(Request $user)
    {
        $now = Carbon::now();
        $title = 'Добавлен новый пользователь - '.$user->name;
        $description = 'Добавлен новый пользователь - '.$user->name.'<br>Дата: '.$now.' <br><b>'.$user->name.':'.$user->email.'</b>';

        $notification = new Notification;
        $notification->title = $title;
        $notification->description = $description;
        $notification->save();
    }

    public static function updateUser(Request $user)
    {
        $now = Carbon::now();
        $title = 'Изменен пользователь - '.$user->name;
        $description = 'Изменен пользователь - '.$user->name.'<br>Дата: '.$now.' <br><b>'.$user->name.'</b><br>Дата оплаты: '.$user->pay_date;

        $notification = new Notification;
        $notification->title = $title;
        $notification->description = $description;
        $notification->save();
    }

    public static function getNotifications()
    {
        $notifications = Notification::where('is_read', 0)->get();
        return $notifications;
    }
}
