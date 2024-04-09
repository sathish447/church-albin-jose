<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;
use DB;

class PasswordChangedMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $response = $next($request);

        $userToken = DB::table('token')
                ->where('user_id', $user->id)
                ->where('device_type',1)
                ->value('web_token');


        if($userToken != \Session::get('login_session_token')){
            Auth::logout();
            return redirect('/agiadm')->with('error', 'Your Seesion was Expired. Please log in again.');
        }   

        return $response;
    }
}
