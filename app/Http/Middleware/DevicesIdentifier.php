<?php

namespace App\Http\Middleware;

use App\GuestInfo;

use Auth;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Closure;

class DevicesIdentifier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $agent = new Agent();
        $device = $agent->device();
        $platform = $agent->platform();
        $browser = $agent->browser();

        if ($device != null && $platform != null && $browser != null) {
            $info = GuestInfo::where('device', $device)->where('platform', $platform)->where('browser', $browser)->pluck('user_id');
            if (in_array(Auth::id(), $info)) {
                GuestInfo::where('user_id', Auth::id())->where('device', $device)->where('platform', $platform)->where('browser', $browser)->update(['updated_at', Carbon::now()]);
            } else {
                $userInfo = new GuestInfo;
                (Auth::id() == null) ? $userInfo->user_id = 0 : $userInfo->user_id = Auth::id();
                $userInfo->device = $device;
                $userInfo->platform = $platform;
                $userInfo->browser = $browser;
                $userInfo->save();
            }

            return $next($request);
        }
        else {
            return back();
        }
    }
}
