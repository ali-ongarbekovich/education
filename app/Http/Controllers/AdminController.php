<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use App\Level;
use App\Day;
use App\GuestInfo;

use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public static function getStatistics()
    {
        $response = [];
        $response['lessons'] = Lesson::count();
        $response['new_users'] = User::where('new', 1)->count();
        $response['all_users'] = User::count();
        $response['levels'] = Level::count();
        $response['HW'] = Day::count();
        return $response;
    }

    public static function getDevices()
    {
        $devices = DB::table('guest_infos')->select('device', DB::raw('COUNT(device) as occurrence'))->groupBy('device')->orderBy('occurrence')->get();
        return json_encode($devices);
    }

    public static function getPlatforms()
    {
        $platforms = DB::table('guest_infos')->select('platform', DB::raw('COUNT(platform) as occurrence'))->groupBy('platform')->orderBy('occurrence')->get();
        return json_encode($platforms);
    }

    public static function getBrowsers()
    {
        $browsers = DB::table('guest_infos')->select('browser', DB::raw('COUNT(browser) as occurrence'))->groupBy('browser')->orderBy('occurrence')->get();
        return json_encode($browsers);
    }

    public static function getTimeInterval()
    {
        $range = DB::table('guest_infos')->select(DB::raw('HOUR(created_at) AS hours'))->limit(1)->get();
        return json_encode($range);
    }

    public static function getVisits()
    {
        $visits = GuestInfo::count();
        return $visits;
    }
}
