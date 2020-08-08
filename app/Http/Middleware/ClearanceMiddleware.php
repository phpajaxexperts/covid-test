<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //echo "<pre>"; print_r(Auth::guard('administrator')->user()); exit;
        //echo "<pre>"; print_r(Auth::user()); exit;

        $route_name =  $request->route()->getName();

        //echo Auth::check(); exit;
        // if(Auth::check() || $route_name=='login'){
        //     if ($route_name=='login') {
        //         return $next($request);
        //     }elseif (Auth::user()->hasPermissionTo('Super Admin')  || $route_name=='login') {
        //         return $next($request);
        //     }
        // }else{
        //     abort('401');
        // }

        //$role->hasPermissionTo('edit articles');

        if (Auth::user()->hasPermissionTo('Super Admin')  || $route_name=='login') {
            return $next($request);
        }


        $route_name =  $request->route()->getName();
        //echo "'".$route_name."'"; exit;
        $prefix =  $request->route()->getPrefix();
        //echo $action = getActionName();
        //exit;
        //echo $prefix; exit;
        if($prefix=='/administrator'){
            if (!Auth::guard('administrator')->user()->hasPermissionTo($route_name) && $route_name!='Administrator Dashboard') {
                abort('401');
            } else {
                return $next($request);
            }
        }

        /*
        if ($request->is('administrator/view-administrators')) {
            //Auth::user()->givePermissionTo('View Administrator');
            //echo "<pre>";  print_r(Auth::guard('administrator')->user()); exit;

            //echo Auth::user()->hasPermissionTo('View Administrator','administrator'); exit;

            if (!Auth::guard('administrator')->user()->hasPermissionTo('View Administrator')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('posts/create')) {
            if (!Auth::user()->hasPermissionTo('Create Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        */

        //if ($request->is('posts/*/edit')) {
        /*
            if (!Auth::user()->hasPermissionTo('Edit Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) {
            if (!Auth::user()->hasPermissionTo('Delete Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        */

        return $next($request);
    }
}