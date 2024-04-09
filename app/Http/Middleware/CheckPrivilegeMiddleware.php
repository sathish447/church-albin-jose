<?php

namespace App\Http\Middleware;

use App\Data\Models\Permission;
use Closure;

class CheckPrivilegeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $route_name = false)
    {
        $response = $next($request);

        $permission = explode(";", $permission);

        // Roles not allowed to Login - Customer, Guest
        if (in_array($request->user()->role_id, [10, 15])) {
            \Auth::logout();
            return redirect()->route('login');
        }

        // Show Only Enabled Modules
        $modules = array_filter(explode(",", conf("enable_modules")));

        if(count($modules) > 0) {
            $allowed = array_intersect($modules, $permission);
            if(count($allowed) == 0) {
                return redirect()->route('admin.dashboard');
            }
        }

        // Block is User/Role is Disabled
        if ($request->user()->is_active == 0 || $request->user()->role->is_active == 0) {
            \Auth::logout();
            return redirect()->route('admin.dashboard')->with('error', "Unauthorized Access.");
        }

        // Allow Developer OR Allow Access if its admin.dashboard pages
        if ($request->user()->role_id == 12 || in_array("dashboard", $permission)) {
            return $response;
        }


        // Allow Developer OR Allow Access if its admin.dashboard pages
        if (in_array("marketing_executive", $permission)) {
            return redirect()->route('admin.dashboard')->with('error', 'Unauthorized Access.');
        }

        // Allow Developer OR Allow Access if its admin.dashboard pages
        if (in_array("online_sales_associate", $permission)) {
            return redirect()->route('admin.dashboard')->with('error', 'Unauthorized Access.');
        }

        // Allow App Developer OR Allow Access if its API Documentation pages
        if ($request->user()->role_id == 16 && in_array("api_doc", $permission)) {
            return $response;
        }

        // Block access to developer menu
        if (in_array("dev", $permission)) {
            return redirect()->route('admin.dashboard')->with('error', 'Unauthorized Access.');
        }

        // Block access to b2b routs in b2c expect super admin and qa
        if ($request->user()->role_id == 11 && $request->user()->role_id == 48 && $request->user()->role_id == 47 && in_array("b2b", $permission)) {
            return redirect()->route('admin.dashboard')->with('error', 'Unauthorized Access.');
        }

        // Allow Super Admin
        if ($request->user()->role_id == 13) {
            return $response;
        }

        // Check Permission for Users
        if ($request->user()->role->hasAnyPermission($permission)) {
        //  dd($request->user()->role->hasAnyPermission($permission));
            return $response;
        }

        return redirect()->route('admin.dashboard')->with('error', "Unauthorized Access.");
    }
}
